<?php
if( is_front_page() ) return;

$crumbs = [
	[
		'url' => '/',
		'name' => 'Home',
	]
];
if( is_singular( 'case-studies' ) ) {
	$crumbs[] = [
		'url' => '/case-studies/',
		'name' => 'Case Studies',
	];
}

$crumbs[] = [
	'name' => get_the_title(),
];
?>
<div class="bg-whisper text-coal-mine w-full">
	<div class="px-sm py-md max-w-1280px mx-auto [&_a]:text-base [&_a]:hover:no-underline [&_span]:text-base">
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