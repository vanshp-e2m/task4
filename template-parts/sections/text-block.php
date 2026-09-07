<?php
/**
 * Template part for Text Block Section
 *
 * @package Vansh_Projects
 */

$text_block = get_field( 'text_block' );
if ( $text_block ) :
	?>
	<section class="text-block-section">
		<div class="container">
			<?php if ( ! empty( $text_block['text_heading'] ) ) : ?>
				<h2 class="text-heading"><?php echo esc_html( $text_block['text_heading'] ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $text_block['text_content'] ) ) : ?>
				<div class="text-content">
					<?php echo wp_kses_post( $text_block['text_content'] ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;