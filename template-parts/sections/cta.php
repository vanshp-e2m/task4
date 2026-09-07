<?php
/**
 * Template part for CTA Section
 *
 * @package Vansh_Projects
 */

$cta_title = get_sub_field( 'cta_title' );
$cta_description = get_sub_field( 'cta_description' );
$cta_button_text = get_sub_field( 'cta_button_text' );
$cta_button_link = get_sub_field( 'cta_button_link' );

if ( $cta_title || $cta_description || $cta_button_text ) :
	?>
	<section class="cta-section">
		<div class="container">
			<div class="cta-content">
				<?php if ( $cta_title ) : ?>
					<h2 class="cta-title"><?php echo esc_html( $cta_title ); ?></h2>
				<?php endif; ?>
				<?php if ( $cta_description ) : ?>
					<p class="cta-description"><?php echo esc_html( $cta_description ); ?></p>
				<?php endif; ?>
				<?php if ( $cta_button_text && $cta_button_link ) : ?>
					<a href="<?php echo esc_url( $cta_button_link ); ?>" class="cta-button">
						<?php echo esc_html( $cta_button_text ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;