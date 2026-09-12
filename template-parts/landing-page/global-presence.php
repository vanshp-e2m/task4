<?php
/**
 * Global Presence Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$items = get_sub_field( 'items' );
$map_image = get_sub_field( 'map_image' );
?>

<section class="global-presence-section">
	<div class="global-presence-container">
		<div class="presence-content">
			<div class="presence-text">
				<?php if ( $heading ) : ?>
					<h2><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $description ) : ?>
					<p><?php echo wp_kses_post( $description ); ?></p>
				<?php endif; ?>

				<?php if ( $items ) : ?>
					<div class="presence-stats">
						<?php foreach ( $items as $item ) : ?>
							<div class="presence-stat">
								<h4><?php echo esc_html( $item['number'] ); ?></h4>
								<p><?php echo esc_html( $item['label'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $map_image ) : ?>
				<div class="presence-map">
					<?php echo wp_get_attachment_image( $map_image, 'large' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<style>
	.global-presence-section {
		padding: 120px 80px;
		background-color: #F5F5F3;
	}

	.global-presence-container {
		max-width: 1400px;
		margin: 0 auto;
	}

	.presence-content {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 60px;
		align-items: center;
	}

	.presence-text h2 {
		font-size: 28px;
		font-weight: 700;
		color: #1F252B;
		margin-bottom: 20px;
	}

	.presence-text p {
		font-size: 16px;
		color: #8A8A8A;
		line-height: 1.6;
		margin-bottom: 40px;
	}

	.presence-stats {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		gap: 30px;
	}

	.presence-stat {
		background: #FFFFFF;
		padding: 25px;
		border-radius: 8px;
	}

	.presence-stat h4 {
		font-size: 24px;
		font-weight: 700;
		color: #6C35D9;
		margin: 0 0 8px 0;
	}

	.presence-stat p {
		font-size: 14px;
		color: #666;
		margin: 0;
	}

	.presence-map {
		width: 100%;
	}

	.presence-map img {
		width: 100%;
		height: auto;
		border-radius: 8px;
	}

	@media (max-width: 1024px) {
		.presence-content {
			grid-template-columns: 1fr;
			gap: 40px;
		}

		.presence-stats {
			grid-template-columns: 1fr;
		}
	}

	@media (max-width: 768px) {
		.global-presence-section {
			padding: 80px 40px;
		}

		.presence-text h2 {
			font-size: 24px;
		}

		.presence-stats {
			grid-template-columns: 1fr;
		}
	}

	@media (max-width: 480px) {
		.global-presence-section {
			padding: 60px 20px;
		}

		.presence-stat {
			padding: 20px;
		}
	}
</style>
