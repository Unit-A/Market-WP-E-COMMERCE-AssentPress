<?php 
$assentpress_menu_style = get_theme_mod('consultstreet_menu_style', 'sticky');   
$assentpress_menu_container_size = get_theme_mod('consultstreet_menu_container_size', 'container-full');
$assentpress_header_banner_image = get_theme_mod('consultstreet_header_banner_image');
$assentpress_header_banner_image_disabled = get_theme_mod('consultstreet_header_banner_image_disabled', true);
$assentpress_header_banner_image_link = get_theme_mod('consultstreet_header_banner_image_link', '#');
$assentpress_header_banner_open_new_tab_disabled = get_theme_mod('consultstreet_header_banner_open_new_tab_disabled', true);
$assentpress_magazine_header_menu_alignment = get_theme_mod('consultstreet_magazine_header_menu_alignment', 'left');
?>
    <!-- Magazine Header with Banner Add -->
	<section class="theme-header-magazine">
		<div class="<?php echo esc_attr($assentpress_menu_container_size); ?>">
			<div class="row">
				<div class="col-lg-<?php if($assentpress_header_banner_image_disabled == false || $assentpress_header_banner_image == null){ echo '12'; } else{ echo '4';} ?> align-self-center">
					<?php echo esc_html( consultstreet_header_logo() ); ?>								
				</div>
            <?php if($assentpress_header_banner_image_disabled == true && $assentpress_header_banner_image != null) {?>
				<div class="col-lg-8">
					<div class="header-add-promotion">	
						<a href="<?php echo esc_attr($assentpress_header_banner_image_link); ?>" <?php if($assentpress_header_banner_open_new_tab_disabled == true){?>target="_blank" <?php }?>><img src="<?php echo esc_attr($assentpress_header_banner_image); ?>" class="img-fluid" alt="Banner"></a>
					</div>								
				</div>
			<?php } ?>
			</div>	
		</div>
	</section>
	<!-- /End of Magazine Header with Banner Add -->
 
	<!-- Magazine Header Menubar -->
	<nav class="navbar navbar-expand-lg not-sticky navbar-light navbar-header-magazine <?php if($assentpress_menu_style == 'sticky'){echo 'header-sticky'; }?>">
		<div class="<?php echo esc_attr($assentpress_menu_container_size); ?>">
			<div class="row align-self-center">
			
					<div class="align-self-center">	
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','assentpress'); ?>">
							<span class="navbar-toggler-icon"></span>
						</button>
					</div>

				    <?php 
						wp_nav_menu( array(
							 'theme_location'  => 'primary',
							 'container'       => 'div',
							 'container_class' => 'collapse navbar-collapse',
							 'container_id' => 'navbarNavDropdown',
							  'menu_class'      => 'nav navbar-nav '.esc_attr($assentpress_magazine_header_menu_alignment).'',
							 'fallback_cb'     => 'consultstreet_wp_bootstrap_navwalker::fallback',
							 'walker'          => new consultstreet_wp_bootstrap_navwalker()
						) );
					?>
				
			</div>
		</div>
	</nav>
	<!-- /End of Magazine Header Menubar -->