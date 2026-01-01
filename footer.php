	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ai-dev-theme' ) ); ?>">
				<?php
				/* translators: %s: CMS Name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'ai-dev-theme' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'ai-dev-theme' ), 'ai-dev-theme', '羊羊羊' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
