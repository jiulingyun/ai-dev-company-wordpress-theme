<?php
/**
 * Custom template tags for this theme
 *
 * @package AI_Dev_Theme
 */

if ( ! function_exists( 'ai_dev_theme_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param object $comment The comment object.
	 * @param array  $args    Arguments.
	 * @param int    $depth   Depth.
	 */
	function ai_dev_theme_comment( $comment, $args, $depth ) {
		// Ensure we have the correct comment object
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				?>
				<li class="post pingback">
					<p><?php esc_html_e( 'Pingback:', 'ai-dev-theme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'ai-dev-theme' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;

			default:
				?>
				<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment-body card p-lg mb-lg border border-secondary border-opacity-25 bg-surface">
						<footer class="comment-meta d-flex align-center mb-md">
							<div class="comment-author vcard me-3">
								<?php
								if ( 0 != $args['avatar_size'] ) {
									echo get_avatar( $comment, $args['avatar_size'], '', '', [ 'class' => 'rounded-circle border border-primary' ] );
								}
								?>
							</div><!-- .comment-author -->

							<div class="comment-metadata">
                                <div class="d-flex align-center mb-1">
                                    <?php printf( '<b class="fn h6 mb-0 me-2 text-white">%s</b>', get_comment_author_link() ); ?>
                                    
                                    <?php if ( '0' == $comment->comment_approved ) : ?>
                                        <span class="badge badge--warning text-xs py-0 px-2"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ai-dev-theme' ); ?></span>
                                    <?php endif; ?>
                                </div>
								<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="text-muted text-xs text-uppercase letter-spacing-sm text-decoration-none">
									<time datetime="<?php comment_time( 'c' ); ?>">
										<?php printf( /* translators: 1: date, 2: time */ esc_html__( '%1$s at %2$s', 'ai-dev-theme' ), get_comment_date(), get_comment_time() ); ?>
									</time>
								</a>
							</div><!-- .comment-metadata -->

                            <div class="ms-auto">
                                <?php edit_comment_link( esc_html__( 'Edit', 'ai-dev-theme' ), '<span class="edit-link text-xs text-muted">', '</span>' ); ?>
                            </div>
						</footer><!-- .comment-meta -->

						<div class="comment-content typography-content text-muted">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->

						<div class="reply mt-md text-end">
							<?php
							comment_reply_link(
								array_merge(
									$args,
									array(
										'add_below' => 'comment',
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
                                        'class'     => 'button button--outline button--sm text-xs',
									)
								)
							);
							?>
						</div><!-- .reply -->
					</article><!-- .comment-body -->
                </li>
				<?php
				break;
		endswitch;
	}
endif;
