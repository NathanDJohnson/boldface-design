<?php
/**
 * Template Functions
 * Helper functions used in templates
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prints HTML with meta information for the current post date/time.
 */
function boldface_design_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	printf(
		'<span class="posted-on">%s %s</span>',
		wp_kses_post( __( 'Posted on', 'boldface-design' ) ),
		wp_kses_post( $time_string )
	);
}

/**
 * Prints HTML with meta information for the current author.
 */
function boldface_design_posted_by() {
	printf(
		'<span class="byline"> %s <span class="author vcard"><a class="url fn n" href="%s">%s</a></span></span>',
		wp_kses_post( __( 'by', 'boldface-design' ) ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function boldface_design_entry_footer() {
	// Only show categories and tags for posts
	if ( 'post' === get_post_type() ) {
		// Hide category and tag text for pages.
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list ) {
			printf(
				'<span class="cat-links">%s %s</span>',
				wp_kses_post( __( 'Categories:', 'boldface-design' ) ),
				wp_kses_post( $categories_list )
			);
		}

		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			printf(
				'<span class="tags-links">%s %s</span>',
				wp_kses_post( __( 'Tags:', 'boldface-design' ) ),
				wp_kses_post( $tags_list )
			);
		}
	}

	// Always show the comments link
	if ( ! is_singular( 'attachment' ) && post_type_supports( get_post_type(), 'comments' ) ) {
		comments_popup_link(
			esc_html__( 'Leave a Comment', 'boldface-design' ),
			esc_html__( '1 Comment', 'boldface-design' ),
			esc_html__( '% Comments', 'boldface-design' )
		);
	}
}

/**
 * Mobile menu toggle script
 */
function boldface_design_mobile_menu_script() {
	?>
	<script>
	document.addEventListener( 'DOMContentLoaded', function() {
		const menuToggle = document.querySelector( '.menu-toggle' );
		const primaryMenu = document.getElementById( 'primary-menu' );

		if ( menuToggle ) {
			menuToggle.addEventListener( 'click', function() {
				const isExpanded = this.getAttribute( 'aria-expanded' ) === 'true';
				this.setAttribute( 'aria-expanded', ! isExpanded );
				primaryMenu.classList.toggle( 'toggled' );
			} );
		}
	} );
	</script>
	<?php
}
add_action( 'wp_footer', 'boldface_design_mobile_menu_script' );

/**
 * Get theme option
 */
function boldface_design_get_option( $option, $default = '' ) {
	$value = get_option( 'boldface_design_' . $option );
	return $value ? $value : $default;
}

/**
 * Get ACF field
 */
function boldface_design_get_field( $field_name, $post_id = false ) {
	if ( ! function_exists( 'get_field' ) ) {
		return false;
	}
	return get_field( $field_name, $post_id );
}
