<?php
/**
 * Template part for CTA Section
 *
 * @package Vansh_Projects
 */

$cta = get_field( 'cta_section' );
if ( $cta ) :
	?>
	<section class="cta-section">
		<div class="container">
			<div class="cta-content">
				<?php if ( ! empty( $cta['cta_title'] ) ) : ?>
					<h2 class="cta-title"><?php echo esc_html( $cta['cta_title'] ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $cta['cta_description'] ) ) : ?>
					<p class="cta-description"><?php echo esc_html( $cta['cta_description'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $cta['cta_button_text'] ) && ! empty( $cta['cta_button_link'] ) ) : ?>
					<a href="<?php echo esc_url( $cta['cta_button_link'] ); ?>" class="cta-button">
						<?php echo esc_html( $cta['cta_button_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;