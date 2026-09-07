<?php
/**
 * Template part for Gallery Section
 *
 * @package Vansh_Projects
 */

$gallery = get_field( 'gallery' );
if ( $gallery ) :
	?>
	<section class="gallery-section">
		<div class="container">
			<div class="gallery-grid">
				<?php foreach ( $gallery as $item ) : ?>
					<div class="gallery-item">
						<?php if ( ! empty( $item['gallery_image'] ) ) : ?>
							<img src="<?php echo esc_url( $item['gallery_image'] ); ?>" alt="<?php echo esc_attr( $item['gallery_caption'] ?? '' ); ?>">
						<?php endif; ?>
						<?php if ( ! empty( $item['gallery_caption'] ) ) : ?>
							<p class="gallery-caption"><?php echo esc_html( $item['gallery_caption'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
endif;