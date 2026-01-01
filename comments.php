<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package AI_Dev_Theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-xl card p-lg">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title h4 mb-lg">
			<?php
			$ai_dev_theme_comment_count = get_comments_number();
			if ( '1' === $ai_dev_theme_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'ai-dev-theme' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $ai_dev_theme_comment_count, 'comments title', 'ai-dev-theme' ) ),
					number_format_i18n( $ai_dev_theme_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list list-unstyled">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 60,
					'callback'   => 'ai_dev_theme_comment', // We will create this function
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments text-muted"><?php esc_html_e( 'Comments are closed.', 'ai-dev-theme' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	$comment_args = array(
        'title_reply'       => __( 'Leave a Reply', 'ai-dev-theme' ),
        'title_reply_to'    => __( 'Leave a Reply to %s', 'ai-dev-theme' ),
        'cancel_reply_link' => __( 'Cancel Reply', 'ai-dev-theme' ),
        'label_submit'      => __( 'Post Comment', 'ai-dev-theme' ),
        'class_submit'      => 'button button--primary mt-md',
        'submit_button'     => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'comment_field'     => '<div class="comment-form-comment mb-md"><label for="comment" class="screen-reader-text">' . _x( 'Comment', 'noun', 'ai-dev-theme' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" class="form-control bg-dark border-secondary text-white" placeholder="' . esc_attr__( 'Your Comment...', 'ai-dev-theme' ) . '"></textarea></div>',
        'fields'            => array(
            'author' => '<div class="row"><div class="comment-form-author col-md-6 mb-md"><label for="author" class="screen-reader-text">' . __( 'Name', 'ai-dev-theme' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" required="required" class="form-control bg-dark border-secondary text-white" placeholder="' . esc_attr__( 'Name*', 'ai-dev-theme' ) . '" /></div>',
            'email'  => '<div class="comment-form-email col-md-6 mb-md"><label for="email" class="screen-reader-text">' . __( 'Email', 'ai-dev-theme' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" class="form-control bg-dark border-secondary text-white" placeholder="' . esc_attr__( 'Email*', 'ai-dev-theme' ) . '" /></div></div>',
            'url'    => '<div class="comment-form-url mb-md"><label for="url" class="screen-reader-text">' . __( 'Website', 'ai-dev-theme' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" class="form-control bg-dark border-secondary text-white" placeholder="' . esc_attr__( 'Website', 'ai-dev-theme' ) . '" /></div>',
            'cookies' => '<p class="comment-form-cookies-consent text-muted small"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . ( empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"' ) . ' />' . ' <label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'ai-dev-theme' ) . '</label></p>',
        ),
    );

	comment_form( $comment_args );
	?>

</div><!-- #comments -->
