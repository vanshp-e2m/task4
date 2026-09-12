<?php
/**
 * Footer CTA Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$button_text = get_sub_field( 'button_text' );
$button_link = get_sub_field( 'button_link' );
$background_image = get_sub_field( 'background_image' );
?>

<section class="footer-cta-section" <?php if ( $background_image ) : ?>style="background-image: url('<?php echo esc_url( wp_get_attachment_url( $background_image ) ); ?>');"<?php endif; ?>>
	<div class="footer-cta-overlay"></div>
	<div class="footer-cta-content">
		<?php if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $description ) : ?>
			<p><?php echo wp_kses_post( $description ); ?></p>
		<?php endif; ?>

		<?php if ( $button_text && $button_link ) : ?>
			<a href="<?php echo esc_url( $button_link ); ?>" class="footer-cta-button">
				<?php echo esc_html( $button_text ); ?> <span class="arrow">→</span>
			</a>
		<?php endif; ?>
	</div>
</section>

<style>
	.footer-cta-section {
		padding: 100px 80px;
		background-size: cover;
		background-position: center;
		position: relative;
		overflow: hidden;
	}

	.footer-cta-overlay {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgba(28, 25, 23, 0.7);
		z-index: 1;
	}

	.footer-cta-content {
		position: relative;
		z-index: 2;
		text-align: center;
		max-width: 800px;
		margin: 0 auto;
	}

	.footer-cta-content h2 {
		font-size: 32px;
		font-weight: 700;
		color: #FFFFFF;
		margin-bottom: 20px;
	}

	.footer-cta-content p {
		font-size: 16px;
		color: rgba(255,255,255,0.9);
		margin-bottom: 30px;
		line-height: 1.6;
	}

	.footer-cta-button {
		display: inline-block;
		padding: 14px 40px;
		background-color: #6C35D9;
		color: #FFFFFF;
		text-decoration: none;
		border-radius: 6px;
		font-weight: 700;
		transition: all 0.3s ease;
	}

	.footer-cta-button:hover {
		background-color: #F6C84C;
		color: #1F252B;
	}

	.footer-cta-button .arrow {
		margin-left: 8px;
	}

	@media (max-width: 768px) {
		.footer-cta-section {
			padding: 80px 40px;
		}

		.footer-cta-content h2 {
			font-size: 24px;
		}

		.footer-cta-content p {
			font-size: 14px;
		}
	}

	@media (max-width: 480px) {
		.footer-cta-section {
			padding: 60px 20px;
		}

		.footer-cta-content h2 {
			font-size: 20px;
		}

		.footer-cta-button {
			width: 100%;
			max-width: 300px;
		}
	}
</style>
