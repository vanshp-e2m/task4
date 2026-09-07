<?php
/**
 * Template part for Text Block Section
 *
 * @package Vansh_Projects
 */

$text_heading = get_sub_field( 'text_heading' );
$text_content = get_sub_field( 'text_content' );

if ( $text_heading || $text_content ) :
	?>
	<section class="text-block-section">
		<div class="container">
			<?php if ( $text_heading ) : ?>
				<h2 class="text-heading"><?php echo esc_html( $text_heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $text_content ) : ?>
				<div class="text-content">
					<?php echo wp_kses_post( $text_content ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;