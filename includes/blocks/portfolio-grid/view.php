<?php
/**
 * Portfolio Grid Block Template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get field values
$heading           = boldface_deorphan( get_field( 'heading' ) ) ?: '';
$content           = boldface_deorphan( get_field( 'content' ) ) ?: '';
$default_filter    = get_field( 'default_filter' ) ?: 'all';
$projects_per_page = intval( get_field( 'projects_per_page' ) ) ?: -1;

// Build class name
$class_name = 'wp-block-boldface-design-portfolio-grid bg-white w-full px-sm md:px-lg py-2xl';

if ( isset( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

if ( isset( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Build ID
$id = '';
if ( isset( $block['anchor'] ) ) {
	$id = 'id="' . esc_attr( $block['anchor'] ) . '"';
}

// Get all skills for filter buttons
$skills = get_terms( array(
	'taxonomy'   => 'skills',
	'hide_empty' => false,
	'orderby'    => 'name',
	'order'      => 'ASC',
) );

// Query all projects as ordered on edit screen
$args = array(
	'post_type'      => 'project',
	'posts_per_page' => $projects_per_page,
	'orderby'        => 'menu_order',
	'order'          => 'DESC',
);

$projects_query = new WP_Query( $args );
$all_projects = $projects_query->posts;
?>

<section class="<?php echo esc_attr( $class_name ); ?>" <?php echo wp_kses_post( $id ); ?>>
	<div class="max-w-1280px mx-auto">
        <?php if ( $heading || $content ) : ?>
            <div class="mb-2xl">
                <?php if ( $heading ) : ?>
                    <h2 class="mb-lg text-mine-shaft"><?php echo wp_kses_post( $heading ); ?></h2>
                <?php endif; ?>

                <?php if ( $content ) : ?>
                    <div class="text-abbey">
                        <?php echo wp_kses_post( wpautop( $content ) ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

		<?php if ( ! is_wp_error( $skills ) && ! empty( $skills ) ) : ?>
            <span class="text-xs font-semibold uppercase tracking-wide text-mine-shaft block mb-sm">Filter by Category</span>

			<select 
				id="portfolio-filter-mobile"
				class="md:hidden w-full mb-2xl px-lg py-sm text-sm font-semibold rounded border-2 border-observatory text-observatory bg-white cursor-pointer hover:bg-whisper transition-all"
				onchange="filterByMobileSelect(this.value)">
				<option value="all">All</option>
				<?php foreach ( $skills as $skill ) : ?>
					<option value="<?php echo esc_attr( $skill->term_id ); ?>">
						<?php echo esc_html( $skill->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>

			<div class="hidden md:flex flex-wrap gap-y-xs gap-x-sm items-center mb-2xl" id="portfolio-filters">				
				<button 
					class="btn btn-sm btn-outline-observatory filter-btn active" 
					data-filter="all"
					data-term-id="all">
					All
				</button>

				<?php foreach ( $skills as $skill ) : ?>
					<button 
						class="btn btn-sm btn-outline-observatory filter-btn" 
						data-filter="skill"
						data-term-id="<?php echo esc_attr( $skill->term_id ); ?>">
						<?php echo esc_html( $skill->name ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $all_projects ) ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-sm lg:gap-lg" id="portfolio-grid">
				<?php foreach ( $all_projects as $project ) : ?>
					<?php
                        $column_span = get_field( 'column_span', $project->ID ) ?: '1';
                        $project_skills = wp_get_post_terms( $project->ID, 'skills', array( 'fields' => 'ids' ) );
                        $skills_data = implode( ',', $project_skills );
                        $grid_class = $column_span === '2' ? 'md:col-span-2' : ( $column_span === '3' ? 'md:col-span-3' : '' );

                        /**
                         * Logic Check: Link Override
                         * Check for an associated Case Study before falling back to the Project permalink.
                         */
                        $case_study_id = get_field( 'case_study_link', $project->ID );
                        $target_url    = $case_study_id ? get_permalink( $case_study_id ) : get_permalink( $project->ID );
					?>
					<a 
						href="<?php echo esc_url( $target_url ); ?>" 
						class="portfolio-item group relative overflow-hidden rounded h-300px md:h-400px flex items-end <?php echo esc_attr( $grid_class ); ?>"
				        data-skills="<?php echo esc_attr( $skills_data ); ?>">
						<?php if ( has_post_thumbnail( $project->ID ) ) : ?>
							<div class="absolute inset-0">
								<?php
								echo wp_kses_post( wp_get_attachment_image(
									get_post_thumbnail_id( $project->ID ),
									'large',
									false,
									array(
										'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300',
									)
								) );
								?>
							</div>
						<?php else : ?>
							<div class="absolute inset-0 bg-whisper"></div>
						<?php endif; ?>

						<div class="absolute inset-0 bg-mine-shaft opacity-50 group-hover:opacity-95 transition-opacity duration-300"></div>

						<div class="absolute inset-0 flex flex-col justify-end p-lg md:p-xl">
							<?php if ( $project->post_title ) : ?>
								<h3 class="text-h4 font-semibold text-white mb-sm group-hover:text-observatory transition-colors duration-300">
									<?php echo wp_kses_post( $project->post_title ); ?>
								</h3>
							<?php endif; ?>

							<?php if ( $project->post_excerpt ) : ?>
								<p class="text-caption text-white line-clamp-2">
									<?php echo wp_kses_post( $project->post_excerpt ); ?>
								</p>
							<?php endif; ?>

							<?php if ( ! empty( $project_skills ) ) : ?>
								<div class="flex flex-wrap gap-x-xs gap-y-xxs mt-md">
									<?php foreach ( $project_skills as $skill_id ) : ?>
										<?php
										$skill = get_term( $skill_id, 'skills' );
										if ( ! is_wp_error( $skill ) ) :
											?>
											<span class="inline-block px-xs py-xxs bg-observatory text-white text-xs font-semibold rounded">
												<?php echo esc_html( $skill->name ); ?>
											</span>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="text-abbey italic"><?php esc_html_e( 'No projects found.', 'boldface-design' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<script>
(function() {
	'use strict';

	const filterButtons = document.querySelectorAll('#portfolio-filters .filter-btn');
	const filterMobile = document.getElementById( 'portfolio-filter-mobile' );
	const portfolioItems = document.querySelectorAll('.portfolio-item');

	if ( ! portfolioItems.length ) {
		return;
	}

	function filterPortfolio( selectedTermId ) {
		portfolioItems.forEach( item => {
			const itemSkills = item.dataset.skills ? item.dataset.skills.split(',') : [];
			
			// Show item if filter is 'all' or item has the selected skill
			let shouldShow = false;
			if ( selectedTermId === 'all' ) {
				shouldShow = true;
			} else if ( itemSkills.includes( selectedTermId.toString() ) ) {
				shouldShow = true;
			}

			if ( shouldShow ) {
				item.style.display = '';
				item.classList.add( 'fade-in' );
			} else {
				item.style.display = 'none';
				item.classList.remove( 'fade-in' );
			}
		} );
	}

	// Desktop button click handler
	if ( filterButtons.length ) {
		filterButtons.forEach( button => {
			button.addEventListener( 'click', function() {
				// Remove active class from all buttons
				filterButtons.forEach( btn => btn.classList.remove( 'active' ) );
				
				// Add active class to clicked button
				this.classList.add( 'active' );

				// Update mobile dropdown
				if ( filterMobile ) {
					filterMobile.value = this.dataset.termId;
				}

				// Get the term ID and filter
				const termId = this.dataset.termId;
				filterPortfolio( termId );
			} );
		} );
	}

	// Mobile dropdown change handler
	window.filterByMobileSelect = function( termId ) {
		// Update active button on desktop (if viewing desktop too)
		if ( filterButtons.length ) {
			filterButtons.forEach( btn => btn.classList.remove( 'active' ) );
			const activeButton = document.querySelector( `[data-term-id="${termId}"]` );
			if ( activeButton ) {
				activeButton.classList.add( 'active' );
			}
		}

		// Filter
		filterPortfolio( termId );
	};

	// Initialize with default filter
	const defaultTermId = '<?php echo esc_js( $default_filter ); ?>';
	if ( defaultTermId && defaultTermId !== 'all' ) {
		const defaultButton = document.querySelector( `[data-term-id="${defaultTermId}"]` );
		if ( defaultButton ) {
			defaultButton.click();
		}
	}
})();
</script>

<style>
.portfolio-item {
	display: block;
	transition: all 0.3s ease;
}

.portfolio-item.fade-in {
	animation: fadeIn 0.3s ease forwards;
}

@keyframes fadeIn {
	from {
		opacity: 0;
	}
	to {
		opacity: 1;
	}
}
</style>
