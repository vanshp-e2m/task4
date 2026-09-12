<?php
/**
 * Hero Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$subheading = get_sub_field( 'subheading' );
$cta_primary_text = get_sub_field( 'cta_primary_text' );
$cta_primary_link = get_sub_field( 'cta_primary_link' );
$cta_secondary_text = get_sub_field( 'cta_secondary_text' );
$cta_secondary_link = get_sub_field( 'cta_secondary_link' );
$bg_image = get_sub_field( 'background_image' );
?>

<section class="hero-section" <?php if ( $bg_image ) echo 'style="background-image: url(' . esc_url( wp_get_attachment_image_url( $bg_image, 'full' ) ) . ')"'; ?>>
	<div class="hero-content">
		<?php if ( $heading ) : ?>
			<h1 class="hero-heading"><?php echo esc_html( $heading ); ?></h1>
		<?php endif; ?>

		<?php if ( $subheading ) : ?>
			<p class="hero-subheading"><?php echo wp_kses_post( $subheading ); ?></p>
		<?php endif; ?>

		<div class="hero-ctas">
			<?php if ( $cta_primary_text && $cta_primary_link ) : ?>
				<a href="<?php echo esc_url( $cta_primary_link ); ?>" class="btn btn-primary">
					<?php echo esc_html( $cta_primary_text ); ?>
				</a>
			<?php endif; ?>

			<?php if ( $cta_secondary_text && $cta_secondary_link ) : ?>
				<a href="<?php echo esc_url( $cta_secondary_link ); ?>" class="btn btn-secondary">
					<?php echo esc_html( $cta_secondary_text ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
