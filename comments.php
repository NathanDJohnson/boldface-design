<?php
/**
 * Comments template
 *
 * @package boldface-design
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If comments are closed and there are comments, let's leave a little note.
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'boldface-design' ); ?></p>
	<?php
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) {
		?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				esc_html_e( '1 Comment', 'boldface-design' );
			} else {
				printf(
					esc_html_n( '%s Comment', '%s Comments', $comment_count, 'boldface-design' ),
					number_format_i18n( $comment_count )
				);
			}
			?>
		</h2>

		<?php
		wp_list_comments( array(
			'style'       => 'div',
			'short_ping'  => true,
			'avatar_size' => 50,
		) );

		$comment_pagination = paginate_comments_links( array(
			'echo' => false,
			'type' => 'list',
		) );

		if ( $comment_pagination ) {
			?>
			<nav class="comment-navigation">
				<?php echo wp_kses_post( $comment_pagination ); ?>
			</nav>
			<?php
		}
	}

	if ( comments_open() ) {
		?>
		<div id="respond" class="comment-respond">
			<h2 id="reply-title" class="comment-reply-title">
				<?php esc_html_e( 'Leave a Reply', 'boldface-design' ); ?>
			</h2>

			<?php
			comment_form( array(
				'logged_in_as'       => '<p class="logged-in-as">' . sprintf(
					wp_kses_post( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Log out?</a>', 'boldface-design' ) ),
					esc_url( admin_url( 'profile.php' ) ),
					esc_html( wp_get_current_user()->user_login ),
					esc_url( wp_logout_url( get_permalink() ) )
				) . '</p>',
				'title_reply'        => esc_html__( 'Leave a Reply', 'boldface-design' ),
				'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'boldface-design' ),
				'cancel_reply_link'  => esc_html__( 'Cancel Reply', 'boldface-design' ),
				'label_submit'       => esc_html__( 'Post Comment', 'boldface-design' ),
			) );
			?>
		</div>
		<?php
	}
	?>
</div>
