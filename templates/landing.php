<?php
/**
 * Template Name: Landing Page
 */
?>
<?php get_header( 'landing' ); ?>

<main id="main">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>

    <section class="wp-block-boldface-design-cta bg-gradient-abyss w-full px-sm md:px-lg py-2xl align">
        <div class="max-w-1100px mx-auto text-center">
            <h2 class="text-white mb-lg">Schedule now</h2>
            
            <div class="flex flex-wrap justify-center gap-md mt-lg">
                <!-- Google Calendar Appointment Scheduling begin -->
                <div id="google-button">
                    <link href="https://calendar.google.com/calendar/scheduling-button-script.css" rel="stylesheet">
                    <script src="https://calendar.google.com/calendar/scheduling-button-script.js" async></script>
                    <script>
                    (function() {
                    var target = document.currentScript;
                    window.addEventListener('load', function() {
                        calendar.schedulingButton.load({
                        url: 'https://calendar.google.com/calendar/appointments/schedules/AcZssZ0WET66vpxOeh9DbqY5g9GrKd0_GK9mAkouWh-v1mxhkxBpDuoaDEOhKHfRpjsE1WGmjExO6aXn?gv=true',
                        color: '#039BE5',
                        label: 'Book an appointment',
                        target,
                        });
                    });
                    })();
                    </script>
                </div>
                <!-- end Google Calendar Appointment Scheduling -->
            </div>
        </div>
    </section>
</main>

<?php get_footer( 'landing' ); ?>
