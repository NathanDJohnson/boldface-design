<?php
/**
 * Search Form Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="flex flex-col sm:flex-row gap-sm">
		<input
			type="search"
			class="flex-1 px-lg py-md rounded-lg border-2 border-whisper focus:border-observatory focus:outline-none text-mine-shaft placeholder-abbey transition-colors bg-white"
			placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'boldface-design' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
			title="<?php echo esc_attr_x( 'Search for:', 'label', 'boldface-design' ); ?>"
		/>
		<button
			type="submit"
			class="px-xl py-md bg-observatory hover:bg-cyprus text-white font-semibold rounded-lg transition-colors inline-flex items-center justify-center whitespace-nowrap"
			title="<?php echo esc_attr_x( 'Search', 'submit button', 'boldface-design' ); ?>"
		>
			<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
			</svg>
			<span class="hidden sm:inline ml-xs"><?php esc_html_e( 'Search', 'boldface-design' ); ?></span>
		</button>
	</div>
</form>
