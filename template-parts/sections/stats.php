<?php
/**
 * Template part for Statistics Section
 *
 * @package Vansh_Projects
 */

$stats = get_field( 'stats' );
if ( $stats ) :
	?>
	<section class="stats-section">
		<div class="container">
			<div class="stats-grid">
				<?php foreach ( $stats as $stat ) : ?>
					<div class="stat-item">
						<?php if ( ! empty( $stat['stat_value'] ) ) : ?>
							<div class="stat-value"><?php echo esc_html( $stat['stat_value'] ); ?></div>
						<?php endif; ?>
						<?php if ( ! empty( $stat['stat_name'] ) ) : ?>
							<div class="stat-name"><?php echo esc_html( $stat['stat_name'] ); ?></div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
endif;