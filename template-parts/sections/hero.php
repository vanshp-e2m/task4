<?php
/**
 * Template part for Hero Section
 *
 * @package Vansh_Projects
 */

$hero_title = get_sub_field( 'hero_title' );
$hero_subtitle = get_sub_field( 'hero_subtitle' );
$hero_background = get_sub_field( 'hero_background' );

if ( $hero_title || $hero_subtitle || $hero_background ) :
	?>
	<section class="hero-section">
		<?php if ( $hero_background ) : ?>
			<div class="hero-background" style="background-image: url('<?php echo esc_url( $hero_background ); ?>');"></div>
		<?php endif; ?>
		<div class="hero-content">
			<?php if ( $hero_title ) : ?>
				<h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
			<?php endif; ?>
			<?php if ( $hero_subtitle ) : ?>
				<p class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;