<?php
/**
 * Steps Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$items = get_sub_field( 'items' );
?>

<section class="steps-section">
	<div class="steps-container">
		<div class="steps-header">
			<?php if ( $heading ) : ?>
				<h2><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p><?php echo wp_kses_post( $description ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $items ) : ?>
			<div class="steps-list">
				<?php foreach ( $items as $index => $item ) : ?>
					<div class="step-item">
						<div class="step-number">
							<span><?php echo intval( $index ) + 1; ?></span>
						</div>

						<div class="step-content">
							<?php if ( ! empty( $item['title'] ) ) : ?>
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $item['description'] ) ) : ?>
								<p><?php echo wp_kses_post( $item['description'] ); ?></p>
							<?php endif; ?>
						</div>

						<?php if ( $index < count( $items ) - 1 ) : ?>
							<div class="step-arrow">→</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<style>
	.steps-section {
		padding: 120px 80px;
		background-color: #FFFFFF;
	}

	.steps-container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.steps-header {
		text-align: center;
		margin-bottom: 80px;
	}

	.steps-header h2 {
		font-size: 28px;
		font-weight: 700;
		color: #1F252B;
		margin-bottom: 20px;
	}

	.steps-header p {
		font-size: 16px;
		color: #8A8A8A;
		max-width: 600px;
		margin: 0 auto;
		line-height: 1.6;
	}

	.steps-list {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		gap: 20px;
	}

	.step-item {
		position: relative;
		text-align: center;
	}

	.step-number {
		width: 60px;
		height: 60px;
		background-color: #6C35D9;
		color: #FFFFFF;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 20px;
		font-weight: 700;
		font-size: 20px;
	}

	.step-content h3 {
		font-size: 18px;
		font-weight: 700;
		color: #1F252B;
		margin-bottom: 10px;
	}

	.step-content p {
		font-size: 14px;
		color: #666;
		line-height: 1.5;
		margin: 0;
	}

	.step-arrow {
		position: absolute;
		right: -30px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 20px;
		color: #F6C84C;
		font-weight: 700;
	}

	.step-item:last-child .step-arrow {
		display: none;
	}

	@media (max-width: 1024px) {
		.steps-list {
			grid-template-columns: repeat(2, 1fr);
			gap: 40px;
		}

		.step-arrow {
			display: none;
		}
	}

	@media (max-width: 768px) {
		.steps-section {
			padding: 80px 40px;
		}

		.steps-list {
			grid-template-columns: 1fr;
		}

		.steps-header h2 {
			font-size: 24px;
		}
	}

	@media (max-width: 480px) {
		.steps-section {
			padding: 60px 20px;
		}

		.step-number {
			width: 50px;
			height: 50px;
			font-size: 18px;
		}
	}
</style>
