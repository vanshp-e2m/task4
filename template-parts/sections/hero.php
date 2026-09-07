<?php
/**
 * Template part for Hero Section
 *
 * @package Vansh_Projects
 */

$hero = get_field( 'hero_section' );
if ( $hero ) :
	?>
	<section class="hero-section">
		<?php if ( ! empty( $hero['hero_background'] ) ) : ?>
			<div class="hero-background" style="background-image: url('<?php echo esc_url( $hero['hero_background'] ); ?>');"></div>
		<?php endif; ?>
		<div class="hero-content">
			<?php if ( ! empty( $hero['hero_title'] ) ) : ?>
				<h1 class="hero-title"><?php echo esc_html( $hero['hero_title'] ); ?></h1>
			<?php endif; ?>
			<?php if ( ! empty( $hero['hero_subtitle'] ) ) : ?>
				<p class="hero-subtitle"><?php echo esc_html( $hero['hero_subtitle'] ); ?></p>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;