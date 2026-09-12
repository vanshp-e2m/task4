<?php
/**
 * Features Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$items = get_sub_field( 'items' );
$cta_text = get_sub_field( 'cta_text' );
$cta_link = get_sub_field( 'cta_link' );
?>

<section class="features-section">
	<div class="features-container">
		<div class="features-header">
			<?php if ( $heading ) : ?>
				<h2><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p class="features-description"><?php echo wp_kses_post( $description ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $items ) : ?>
			<div class="features-list">
				<?php foreach ( $items as $item ) : ?>
					<div class="feature-item">
						<?php if ( ! empty( $item['icon'] ) ) : ?>
							<div class="feature-icon">
								<?php echo wp_get_attachment_image( $item['icon'], 'medium' ); ?>
							</div>
						<?php endif; ?>

						<div class="feature-content">
							<?php if ( ! empty( $item['title'] ) ) : ?>
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $item['text'] ) ) : ?>
								<p><?php echo wp_kses_post( $item['text'] ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $cta_text && $cta_link ) : ?>
			<div class="features-cta">
				<a href="<?php echo esc_url( $cta_link ); ?>" class="btn btn-primary">
					<?php echo esc_html( $cta_text ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>

<style>
	.features-section {
		padding: 120px 80px;
		background-color: #F5F5F3;
	}

	.features-container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.features-header {
		text-align: center;
		margin-bottom: 60px;
	}

	.features-header h2 {
		font-size: 28px;
		font-weight: 700;
		color: #1F252B;
		margin-bottom: 20px;
	}

	.features-description {
		font-size: 16px;
		color: #8A8A8A;
		max-width: 600px;
		margin: 0 auto;
		line-height: 1.6;
	}

	.features-list {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 40px;
		margin-bottom: 40px;
	}

	.feature-item {
		background: #FFFFFF;
		padding: 30px;
		border-radius: 8px;
		text-align: center;
	}

	.feature-icon {
		width: 80px;
		height: 80px;
		margin: 0 auto 20px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.feature-icon img {
		max-width: 100%;
		height: auto;
	}

	.feature-content h3 {
		font-size: 18px;
		font-weight: 700;
		color: #1F252B;
		margin-bottom: 12px;
	}

	.feature-content p {
		font-size: 14px;
		color: #666;
		line-height: 1.6;
	}

	.features-cta {
		text-align: center;
	}

	.btn {
		display: inline-block;
		padding: 12px 30px;
		background-color: #1F252B;
		color: white;
		text-decoration: none;
		border-radius: 6px;
		font-weight: 600;
		transition: background-color 0.3s ease;
	}

	.btn:hover {
		background-color: #6C35D9;
	}

	@media (max-width: 1024px) {
		.features-list {
			grid-template-columns: repeat(2, 1fr);
		}
	}

	@media (max-width: 768px) {
		.features-section {
			padding: 80px 40px;
		}

		.features-list {
			grid-template-columns: 1fr;
		}

		.features-header h2 {
			font-size: 24px;
		}
	}

	@media (max-width: 480px) {
		.features-section {
			padding: 60px 20px;
		}

		.feature-item {
			padding: 20px;
		}
	}
</style>
