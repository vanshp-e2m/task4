<?php
/**
 * Template part for Two Column Section
 *
 * @package Vansh_Projects
 */

$column_left = get_sub_field( 'column_left' );
$column_right = get_sub_field( 'column_right' );

if ( $column_left || $column_right ) :
	?>
	<section class="two-column-section">
		<div class="container">
			<div class="two-column-grid">
				<?php if ( $column_left ) : ?>
					<div class="column-left">
						<?php echo wp_kses_post( $column_left ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $column_right ) : ?>
					<div class="column-right">
						<?php echo wp_kses_post( $column_right ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;