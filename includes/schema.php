<?php
/**
 * Schema Markup
 * Structured data and schema markup for SEO
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inject FAQ schema into head if the current post has FAQ blocks
 */
add_action( 'wp_head', function() {
	if ( ! is_singular() ) {
		return;
	}

	$post_id = get_the_ID();
	$post = get_post( $post_id );

	if ( ! $post || ! has_blocks( $post ) ) {
		return;
	}

	// Check if the post has FAQ blocks
	$blocks = parse_blocks( $post->post_content );
	$faq_data = boldface_design_extract_faq_blocks( $blocks );

	if ( empty( $faq_data ) ) {
		return;
	}

	// Build FAQ schema
	$faq_schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array(),
	);

	foreach ( $faq_data as $faq_item ) {
		
		$faq_schema['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => $faq_item['question'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq_item['answer'] ),
			),
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema ) . '</script>' . "\n";
}, 100 );

/**
 * Extract FAQ blocks from post blocks recursively
 * 
 * @param array $blocks The parsed blocks
 * @return array Array of FAQ items grouped by block
 */
function boldface_design_extract_faq_blocks( $blocks ) {
	$faq_data = array();

	foreach ( $blocks as $block ) {
		// Check if this is an FAQ block
		if ( isset( $block['blockName'] ) && 'boldface-design/faq' === $block['blockName'] ) {
			$n = $block['attrs']['data']['faq_items'] ?? 0;
			$faq_items = array();

			for ( $i = 0; $i < $n; $i++ ) {
				$faq_data[] = array(
					'question' => $block['attrs']['data']["faq_items_{$i}_question"] ?? '',
					'answer'   => $block['attrs']['data']["faq_items_{$i}_answer"] ?? '',
				);
			}			
		}
	}

	return $faq_data;
}

/**
 * Inject "Case Studies" hub into Yoast Schema for single case studies
 */
add_filter( 'wpseo_breadcrumb_links', function( $links ) {
    // Only target single 'case-studies' post type
    if ( is_singular( 'case-studies' ) ) {
        
        // Define our "Hub" breadcrumb
        $case_studies_hub = [
            'url'  => home_url( '/case-studies/' ),
            'text' => 'Case Studies',
        ];

        // Inject the hub at index 1 (between 'Home' and the 'Single Post Title')
        array_splice( $links, 1, 0, [ $case_studies_hub ] );
    }

    return $links;
});
