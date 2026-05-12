<?php
$current_post_id = get_the_ID();
$homepage_id     = (int) get_option( 'page_on_front' );

if ( ( is_admin() && $current_post_id === $homepage_id ) ) {
    return;
}

if( is_front_page() ) return;

$crumbs = [
	[
		'url' => '/',
		'name' => 'Home',
	]
];

$post_id = get_the_ID();
$post_type = get_post_type();

// For hierarchical post types, get all ancestors
if( is_post_type_hierarchical( $post_type ) ) {
	$ancestors = get_post_ancestors( $post_id );
	$ancestors = array_reverse( $ancestors );
	
	foreach( $ancestors as $ancestor_id ) {
		$crumbs[] = [
			'url' => get_permalink( $ancestor_id ),
			'name' => get_the_title( $ancestor_id ),
		];
	}
}
// For non-hierarchical custom post types, check for pseudo-archive page
else if( $post_type !== 'post' && $post_type !== 'page' ) {
	$archive_page = get_page_by_path( $post_type, OBJECT, 'page' );
	
	if( $archive_page ) {
		$crumbs[] = [
			'url' => get_permalink( $archive_page->ID ),
			'name' => get_the_title( $archive_page->ID ),
		];
	}
}

$crumbs[] = [
	'name' => get_the_title(),
];
?>
<div class="bg-whisper text-coal-mine w-full">
	<div class="px-sm py-md max-w-1280px mx-auto [&_a]:text-base [&_a]:underline [&_a:hover]:no-underline [&_span]:text-base">
		<?php foreach( $crumbs as $key => $crumb ) : ?>
			<?php if( $key !== 0 ) : ?>
				<span> / </span>
			<?php endif; ?>
			<?php if( ! empty( $crumb[ 'url' ] ) ) : ?>
				<a href="<?php echo $crumb[ 'url' ]; ?>"><?php echo $crumb[ 'name' ]; ?></a>
			<?php else : ?>
				<span><?php echo $crumb[ 'name' ]; ?></span>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>