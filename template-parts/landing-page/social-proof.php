<?php
/**
 * Social Proof Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$logos = get_sub_field( 'logos' );
?>

<section class="social-proof-section">
	<div class="social-proof-container">
		<?php if ( $heading ) : ?>
			<h2 class="social-proof-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $description ) : ?>
			<p class="social-proof-description"><?php echo wp_kses_post( $description ); ?></p>
		<?php endif; ?>

		<?php if ( $logos ) : ?>
			<div class="logos-grid">
				<?php foreach ( $logos as $logo ) : ?>
					<div class="logo-item">
						<?php if ( ! empty( $logo['logo'] ) ) : ?>
							<?php echo wp_get_attachment_image( $logo['logo'], 'medium' ); ?>
						<?php endif; ?>

						<?php if ( ! empty( $logo['company_name'] ) ) : ?>
							<p><?php echo esc_html( $logo['company_name'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<style>
	.social-proof-section {
		padding: 100px 80px;
		background: linear-gradient(180deg, #FFFFFF 0%, #F5F5F3 100%);
	}

	.social-proof-container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.social-proof-heading {
		font-size: 24px;
		font-weight: 700;
		text-align: center;
		color: #1F252B;
		margin-bottom: 15px;
	}

	.social-proof-description {
		font-size: 14px;
		color: #8A8A8A;
		text-align: center;
		margin-bottom: 50px;
	}

	.logos-grid {
		display: grid;
		grid-template-columns: repeat(6, 1fr);
		gap: 40px;
		align-items: center;
	}

	.logo-item {
		text-align: center;
		opacity: 0.7;
		transition: opacity 0.3s ease;
	}

	.logo-item:hover {
		opacity: 1;
	}

	.logo-item img {
		max-width: 100%;
		height: auto;
		margin-bottom: 10px;
	}

	.logo-item p {
		font-size: 12px;
		color: #8A8A8A;
		margin: 0;
	}

	@media (max-width: 1024px) {
		.logos-grid {
			grid-template-columns: repeat(4, 1fr);
		}
	}

	@media (max-width: 768px) {
		.social-proof-section {
			padding: 80px 40px;
		}

		.logos-grid {
			grid-template-columns: repeat(3, 1fr);
			gap: 30px;
		}

		.social-proof-heading {
			font-size: 20px;
		}
	}

	@media (max-width: 480px) {
		.social-proof-section {
			padding: 60px 20px;
		}

		.logos-grid {
			grid-template-columns: repeat(2, 1fr);
			gap: 20px;
		}

		.logo-item img {
			margin-bottom: 8px;
		}
	}
</style>
