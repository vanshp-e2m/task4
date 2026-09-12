<?php
/**
 * Call to Action Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$button_text = get_sub_field( 'button_text' );
$button_link = get_sub_field( 'button_link' );
?>

<section class="cta-section">
	<div class="cta-content">
		<?php if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $description ) : ?>
			<p><?php echo wp_kses_post( $description ); ?></p>
		<?php endif; ?>

		<?php if ( $button_text && $button_link ) : ?>
			<a href="<?php echo esc_url( $button_link ); ?>" class="cta-button">
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif; ?>
	</div>
</section>

<style>
	.cta-section {
		padding: 100px 80px;
		background: linear-gradient(135deg, #6C35D9 0%, #7038D6 100%);
		text-align: center;
	}

	.cta-content h2 {
		font-size: 32px;
		font-weight: 700;
		color: #FFFFFF;
		margin-bottom: 20px;
	}

	.cta-content p {
		font-size: 16px;
		color: rgba(255,255,255,0.9);
		max-width: 600px;
		margin: 0 auto 30px;
		line-height: 1.6;
	}

	.cta-button {
		display: inline-block;
		padding: 14px 40px;
		background-color: #F6C84C;
		color: #1F252B;
		text-decoration: none;
		border-radius: 6px;
		font-weight: 700;
		transition: all 0.3s ease;
	}

	.cta-button:hover {
		background-color: #FFFFFF;
		transform: scale(1.05);
	}

	@media (max-width: 768px) {
		.cta-section {
			padding: 80px 40px;
		}

		.cta-content h2 {
			font-size: 24px;
		}

		.cta-content p {
			font-size: 14px;
		}
	}

	@media (max-width: 480px) {
		.cta-section {
			padding: 60px 20px;
		}

		.cta-content h2 {
			font-size: 20px;
		}

		.cta-button {
			width: 100%;
			max-width: 300px;
		}
	}
</style>
