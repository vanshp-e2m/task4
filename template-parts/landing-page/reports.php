<?php
/**
 * Reports/Stats Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$items = get_sub_field( 'items' );
?>

<section class="reports-section">
	<div class="reports-container">
		<?php if ( $heading ) : ?>
			<h2 class="reports-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $items ) : ?>
			<div class="reports-grid">
				<?php foreach ( $items as $item ) : ?>
					<div class="report-card">
						<?php if ( ! empty( $item['icon'] ) ) : ?>
							<div class="report-icon">
								<?php echo wp_get_attachment_image( $item['icon'], 'medium' ); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $item['value'] ) ) : ?>
							<h3 class="report-value"><?php echo esc_html( $item['value'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $item['label'] ) ) : ?>
							<p class="report-label"><?php echo esc_html( $item['label'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $item['description'] ) ) : ?>
							<p class="report-description"><?php echo wp_kses_post( $item['description'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<style>
	.reports-section {
		padding: 120px 80px;
		background-color: #1F252B;
	}

	.reports-container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.reports-heading {
		font-size: 28px;
		font-weight: 700;
		text-align: center;
		color: #FFFFFF;
		margin-bottom: 60px;
	}

	.reports-grid {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 30px;
	}

	.report-card {
		background: rgba(108, 53, 217, 0.1);
		padding: 40px 30px;
		border-radius: 8px;
		text-align: center;
		border: 1px solid rgba(108, 53, 217, 0.3);
		transition: all 0.3s ease;
	}

	.report-card:hover {
		background: rgba(108, 53, 217, 0.2);
		border-color: #6C35D9;
	}

	.report-icon {
		width: 60px;
		height: 60px;
		margin: 0 auto 20px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.report-icon img {
		max-width: 100%;
		height: auto;
	}

	.report-value {
		font-size: 36px;
		font-weight: 700;
		color: #F6C84C;
		margin: 10px 0;
	}

	.report-label {
		font-size: 16px;
		font-weight: 600;
		color: #FFFFFF;
		margin-bottom: 10px;
	}

	.report-description {
		font-size: 12px;
		color: #B0B0B0;
		line-height: 1.5;
		margin: 0;
	}

	@media (max-width: 1024px) {
		.reports-grid {
			grid-template-columns: repeat(2, 1fr);
		}
	}

	@media (max-width: 768px) {
		.reports-section {
			padding: 80px 40px;
		}

		.reports-grid {
			grid-template-columns: 1fr;
		}

		.reports-heading {
			font-size: 24px;
		}
	}

	@media (max-width: 480px) {
		.reports-section {
			padding: 60px 20px;
		}

		.report-card {
			padding: 30px 20px;
		}
	}
</style>
