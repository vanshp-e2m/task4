<?php
/**
 * Testimonials Section - Landing Page
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$items = get_sub_field( 'items' );
?>

<section class="testimonials-section">
	<div class="testimonials-container">
		<?php if ( $heading ) : ?>
			<h2 class="testimonials-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $items ) : ?>
			<div class="testimonials-grid">
				<?php foreach ( $items as $item ) : ?>
					<div class="testimonial-card">
						<div class="testimonial-quote">
							<span class="quote-mark">"</span>
							<p><?php echo wp_kses_post( $item['quote'] ); ?></p>
						</div>

						<div class="testimonial-author">
							<?php if ( ! empty( $item['avatar'] ) ) : ?>
								<div class="author-avatar">
									<?php echo wp_get_attachment_image( $item['avatar'], 'thumbnail' ); ?>
								</div>
							<?php endif; ?>

							<div class="author-info">
								<h4 class="author-name"><?php echo esc_html( $item['author'] ); ?></h4>
								<?php if ( ! empty( $item['role'] ) ) : ?>
									<p class="author-role"><?php echo esc_html( $item['role'] ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<style>
	.testimonials-section {
		padding: 120px 80px;
		background-color: #FFFFFF;
	}

	.testimonials-container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.testimonials-heading {
		font-size: 28px;
		font-weight: 700;
		text-align: center;
		margin-bottom: 60px;
		color: #1F252B;
	}

	.testimonials-grid {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		gap: 40px;
	}

	.testimonial-card {
		background: #F5F5F3;
		padding: 40px;
		border-radius: 12px;
		border-left: 4px solid #6C35D9;
	}

	.testimonial-quote {
		margin-bottom: 30px;
	}

	.quote-mark {
		font-size: 48px;
		color: #F6C84C;
		font-weight: 700;
		line-height: 0;
	}

	.testimonial-quote p {
		font-size: 16px;
		color: #1F252B;
		line-height: 1.6;
		margin: 15px 0 0 0;
	}

	.testimonial-author {
		display: flex;
		align-items: center;
		gap: 16px;
	}

	.author-avatar {
		width: 50px;
		height: 50px;
		border-radius: 50%;
		overflow: hidden;
		flex-shrink: 0;
	}

	.author-avatar img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.author-info {
		flex: 1;
	}

	.author-name {
		font-size: 14px;
		font-weight: 700;
		color: #1F252B;
		margin: 0;
	}

	.author-role {
		font-size: 12px;
		color: #8A8A8A;
		margin: 4px 0 0 0;
	}

	@media (max-width: 768px) {
		.testimonials-section {
			padding: 80px 40px;
		}

		.testimonials-grid {
			grid-template-columns: 1fr;
			gap: 30px;
		}

		.testimonial-card {
			padding: 30px;
		}
	}

	@media (max-width: 480px) {
		.testimonials-section {
			padding: 60px 20px;
		}

		.testimonials-heading {
			font-size: 24px;
		}
	}
</style>
