<?php
/**
 * Template part for Two Column Section
 *
 * @package Vansh_Projects
 */

$two_column = get_field( 'two_column' );
if ( $two_column ) :
	?>
	<section class="two-column-section">
		<div class="container">
			<div class="two-column-grid">
				<?php if ( ! empty( $two_column['column_left'] ) ) : ?>
					<div class="column-left">
						<?php echo wp_kses_post( $two_column['column_left'] ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $two_column['column_right'] ) ) : ?>
					<div class="column-right">
						<?php echo wp_kses_post( $two_column['column_right'] ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;