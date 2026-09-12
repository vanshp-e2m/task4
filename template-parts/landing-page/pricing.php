<?php
/**
 * Pricing Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$plans = get_sub_field( 'plans' );
?>

<section class="pricing-section">
	<div class="pricing-container">
		<?php if ( $heading ) : ?>
			<h2 class="pricing-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $plans ) : ?>
			<div class="pricing-grid">
				<?php foreach ( $plans as $plan ) : ?>
					<div class="pricing-card">
						<div class="plan-header">
							<h3 class="plan-name"><?php echo esc_html( $plan['name'] ); ?></h3>
						</div>

						<div class="plan-price">
							<span class="price">$<?php echo esc_html( $plan['price'] ); ?></span>
							<span class="billing">/<?php echo esc_html( $plan['billing'] ); ?></span>
						</div>

						<div class="plan-features">
							<?php 
							$features = explode( "\n", $plan['features'] );
							foreach ( $features as $feature ) :
								$feature = trim( $feature );
								if ( ! empty( $feature ) ) :
									?>
									<div class="feature">
										<span class="feature-check">●</span>
										<span><?php echo esc_html( $feature ); ?></span>
									</div>
									<?php
								endif;
							endforeach;
							?>
						</div>

						<?php if ( ! empty( $plan['cta_text'] ) ) : ?>
							<button class="btn btn-subscribe">
								<?php echo esc_html( $plan['cta_text'] ); ?>
							</button>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<style>
	.pricing-section {
		padding: 120px 80px;
		background-color: #F5F5F3;
	}

	.pricing-container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.pricing-heading {
		font-size: 28px;
		font-weight: 700;
		text-align: center;
		margin-bottom: 60px;
		color: #1F252B;
	}

	.pricing-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 40px;
	}

	.pricing-card {
		background: #FFFFFF;
		border-radius: 12px;
		padding: 40px 30px;
		border: 2px solid transparent;
		transition: all 0.3s ease;
	}

	.pricing-card:hover {
		border-color: #6C35D9;
		transform: translateY(-10px);
		box-shadow: 0 15px 40px rgba(108, 53, 217, 0.15);
	}

	.plan-header {
		text-align: center;
		margin-bottom: 20px;
	}

	.plan-name {
		font-size: 20px;
		font-weight: 700;
		color: #1F252B;
	}

	.plan-price {
		text-align: center;
		margin-bottom: 30px;
	}

	.price {
		font-size: 36px;
		font-weight: 700;
		color: #6C35D9;
	}

	.billing {
		font-size: 14px;
		color: #8A8A8A;
		margin-left: 5px;
	}

	.plan-features {
		margin-bottom: 30px;
	}

	.feature {
		display: flex;
		align-items: center;
		font-size: 14px;
		color: #666;
		margin-bottom: 12px;
		line-height: 1.5;
	}

	.feature-check {
		color: #6C35D9;
		margin-right: 12px;
		font-weight: bold;
	}

	.btn-subscribe {
		width: 100%;
		padding: 14px 20px;
		background-color: #1F252B;
		color: white;
		border: none;
		border-radius: 6px;
		font-size: 14px;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.3s ease;
	}

	.btn-subscribe:hover {
		background-color: #6C35D9;
	}

	@media (max-width: 1024px) {
		.pricing-grid {
			grid-template-columns: repeat(2, 1fr);
			gap: 30px;
		}
	}

	@media (max-width: 768px) {
		.pricing-section {
			padding: 80px 40px;
		}

		.pricing-grid {
			grid-template-columns: 1fr;
		}

		.pricing-card {
			padding: 30px 20px;
		}

		.price {
			font-size: 28px;
		}
	}

	@media (max-width: 480px) {
		.pricing-section {
			padding: 60px 20px;
		}

		.pricing-heading {
			font-size: 24px;
			margin-bottom: 40px;
		}
	}
</style>
