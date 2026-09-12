<?php
/**
 * Blog Resources Section - Landing Page
 * Dynamic query of latest blog posts
 * @package Vansh_Projects
 */

$heading = get_sub_field( 'heading' );
$count = get_sub_field( 'count' ) ?: 3;

$args = array(
	'post_type'      => 'post',
	'posts_per_page' => $count,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

$query = new WP_Query( $args );
?>

<section class="blog-resources-section">
	<div class="container">
		<?php if ( $heading ) : ?>
			<h2 class="section-heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $query->have_posts() ) : ?>
			<div class="blog-grid">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<article class="blog-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="blog-image">
								<?php the_post_thumbnail( 'medium' ); ?>
							</div>
						<?php endif; ?>

						<div class="blog-content">
							<h3 class="blog-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>

							<p class="blog-date">
								<?php echo get_the_date( 'M d, Y' ); ?>
							</p>

							<p class="blog-excerpt">
								<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
							</p>

							<a href="<?php the_permalink(); ?>" class="blog-link">
								Read More →
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p class="no-posts">No blog posts found.</p>
		<?php endif; ?>
	</div>
</section>

<style>
	.blog-resources-section {
		padding: 120px 80px;
		background-color: #FFFFFF;
	}

	.container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.section-heading {
		font-size: 28px;
		font-weight: 700;
		text-align: center;
		margin-bottom: 60px;
		color: #1F252B;
	}

	.blog-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 40px;
	}

	.blog-card {
		background: #F5F5F3;
		border-radius: 8px;
		overflow: hidden;
		transition: transform 0.3s ease, box-shadow 0.3s ease;
	}

	.blog-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 30px rgba(0,0,0,0.1);
	}

	.blog-image {
		width: 100%;
		height: 200px;
		overflow: hidden;
		background-color: #E0E0E0;
	}

	.blog-image img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.blog-content {
		padding: 24px;
	}

	.blog-title {
		font-size: 18px;
		font-weight: 700;
		margin-bottom: 12px;
		line-height: 1.3;
	}

	.blog-title a {
		color: #1F252B;
		text-decoration: none;
	}

	.blog-title a:hover {
		color: #6C35D9;
	}

	.blog-date {
		font-size: 12px;
		color: #8A8A8A;
		margin-bottom: 16px;
	}

	.blog-excerpt {
		font-size: 14px;
		color: #666;
		line-height: 1.5;
		margin-bottom: 16px;
	}

	.blog-link {
		font-size: 14px;
		color: #6C35D9;
		text-decoration: none;
		font-weight: 600;
		transition: color 0.3s ease;
	}

	.blog-link:hover {
		color: #F6C84C;
	}

	.no-posts {
		text-align: center;
		color: #8A8A8A;
		padding: 40px;
	}

	@media (max-width: 1024px) {
		.blog-grid {
			grid-template-columns: repeat(2, 1fr);
			gap: 30px;
		}
	}

	@media (max-width: 768px) {
		.blog-resources-section {
			padding: 80px 40px;
		}

		.blog-grid {
			grid-template-columns: 1fr;
		}

		.section-heading {
			font-size: 24px;
			margin-bottom: 40px;
		}
	}

	@media (max-width: 480px) {
		.blog-resources-section {
			padding: 60px 20px;
		}

		.blog-image {
			height: 150px;
		}

		.blog-content {
			padding: 16px;
		}
	}
</style>
