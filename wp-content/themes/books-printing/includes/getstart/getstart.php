<?php
//about theme info
add_action( 'admin_menu', 'books_printing_gettingstarted' );
function books_printing_gettingstarted() {
	add_theme_page( esc_html__('Books Printing', 'books-printing'), esc_html__('Books Printing', 'books-printing'), 'edit_theme_options', 'books_printing_about', 'books_printing_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function books_printing_admin_theme_style() {
	wp_enqueue_style('books-printing-custom-admin-style', esc_url(get_template_directory_uri()) . '/includes/getstart/getstart.css');
	wp_enqueue_script('books-printing-tabs', esc_url(get_template_directory_uri()) . '/includes/getstart/js/tab.js');
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'books_printing_admin_theme_style');

// Changelog
if ( ! defined( 'BOOKS_PRINTING_CHANGELOG_URL' ) ) {
    define( 'BOOKS_PRINTING_CHANGELOG_URL', get_template_directory() . '/readme.txt' );
}

function books_printing_changelog_screen() {	
	global $wp_filesystem;
	$changelog_file = apply_filters( 'books_printing_changelog_file', BOOKS_PRINTING_CHANGELOG_URL );
	if ( $changelog_file && is_readable( $changelog_file ) ) {
		WP_Filesystem();
		$changelog = $wp_filesystem->get_contents( $changelog_file );
		$changelog_list = books_printing_parse_changelog( $changelog );
		echo wp_kses_post( $changelog_list );
	}
}

function books_printing_parse_changelog( $content ) {
	$content = explode ( '== ', $content );
	$changelog_isolated = '';
	foreach ( $content as $key => $value ) {
		if (strpos( $value, 'Changelog ==') === 0) {
	    	$changelog_isolated = str_replace( 'Changelog ==', '', $value );
	    }
	}
	$changelog_array = explode( '= ', $changelog_isolated );
	unset( $changelog_array[0] );
	$changelog = '<div class="changelog">';
	foreach ( $changelog_array as $value) {
		$value = preg_replace( '/\n+/', '</span><span>', $value );
		$value = '<div class="block"><span class="heading">= ' . $value . '</span></div><hr>';
		$changelog .= str_replace( '<span></span>', '', $value );
	}
	$changelog .= '</div>';
	return wp_kses_post( $changelog );
}

//guidline for about theme
function books_printing_mostrar_guide() { 
	//custom function about theme customizer
	$books_printing_return = add_query_arg( array()) ;
	$books_printing_theme = wp_get_theme( 'books-printing' );
?>

    <div class="top-head">
		<div class="top-title">
			<h2><?php esc_html_e( 'Books Printing', 'books-printing' ); ?></h2>
		</div>
		<div class="top-right">
			<span class="version"><?php esc_html_e( 'Version', 'books-printing' ); ?>: <?php echo esc_html($books_printing_theme['Version']);?></span>
		</div>
    </div>

    <div class="inner-cont">

	    <div class="tab-sec">
	    	<div class="tab">
				<button class="tablinks" onclick="books_printing_open_tab(event, 'wpelemento_importer_editor')"><?php esc_html_e( 'Setup With Elementor', 'books-printing' ); ?></button>
				<button class="tablinks" onclick="books_printing_open_tab(event, 'setup_customizer')"><?php esc_html_e( 'Setup With Customizer', 'books-printing' ); ?></button>
				<button class="tablinks" onclick="books_printing_open_tab(event, 'changelog_cont')"><?php esc_html_e( 'Changelog', 'books-printing' ); ?></button>
			</div>

			<div id="wpelemento_importer_editor" class="tabcontent open">
				<?php if(!class_exists('WPElemento_Importer_ThemeWhizzie')){
					$plugin_ins = Books_Printing_Plugin_Activation_WPElemento_Importer::get_instance();
					$books_printing_actions = $plugin_ins->recommended_actions;
					?>
					<div class="books-printing-recommended-plugins ">
							<div class="books-printing-action-list">
								<?php if ($books_printing_actions): foreach ($books_printing_actions as $key => $books_printing_actionValue): ?>
										<div class="books-printing-action" id="<?php echo esc_attr($books_printing_actionValue['id']);?>">
											<div class="action-inner plugin-activation-redirect">
												<h3 class="action-title"><?php echo esc_html($books_printing_actionValue['title']); ?></h3>
												<div class="action-desc"><?php echo esc_html($books_printing_actionValue['desc']); ?></div>
												<?php echo wp_kses_post($books_printing_actionValue['link']); ?>
											</div>
										</div>
									<?php endforeach;
								endif; ?>
							</div>
					</div>
				<?php }else{ ?>
					<div class="tab-outer-box">
						<h3><?php esc_html_e('Welcome to WPElemento Theme!', 'books-printing'); ?></h3>
						<p><?php esc_html_e('Click on the quick start button to import the demo.', 'books-printing'); ?></p>
						<div class="info-link">
							<a  href="<?php echo esc_url( admin_url('admin.php?page=wpelementoimporter-wizard') ); ?>"><?php esc_html_e('Quick Start', 'books-printing'); ?></a>
						</div>
					</div>
				<?php } ?>
			</div>

			<div id="setup_customizer" class="tabcontent ">
				<div class="tab-outer-box">
				  	<div class="lite-theme-inner">
						<h3><?php esc_html_e('Theme Customizer', 'books-printing'); ?></h3>
						<p><?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'books-printing'); ?></p>
						<div class="info-link">
							<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'books-printing'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Help Docs', 'books-printing'); ?></h3>
						<p><?php esc_html_e('The complete procedure to configure and manage a WordPress Website from the beginning is shown in this documentation .', 'books-printing'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( BOOKS_PRINTING_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'books-printing'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Need Support?', 'books-printing'); ?></h3>
						<p><?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'books-printing'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( BOOKS_PRINTING_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'books-printing'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Reviews & Testimonials', 'books-printing'); ?></h3>
						<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'books-printing'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( BOOKS_PRINTING_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'books-printing'); ?></a>
						</div>
						<hr>
						<div class="link-customizer">
							<h3><?php esc_html_e( 'Link to customizer', 'books-printing' ); ?></h3>
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','books-printing'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','books-printing'); ?></a>
									</div>
								</div>
							
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Header Image','books-printing'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','books-printing'); ?></a>
									</div>
								</div>
							</div>
						</div>
				  	</div>
				</div>
			</div>

			<div id="changelog_cont" class="tabcontent">
				<div class="tab-outer-box">
					<?php books_printing_changelog_screen(); ?>
				</div>
			</div>
			
		</div>

		<div class="inner-side-content">
			<h2><?php esc_html_e('Premium Theme', 'books-printing'); ?></h2>
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
				<h3><?php esc_html_e('Books Printing WordPress Theme', 'books-printing'); ?></h3>
				<div class="iner-sidebar-pro-btn">
					<span class="premium-btn"><a href="<?php echo esc_url( BOOKS_PRINTING_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium', 'books-printing'); ?></a>
					</span>
					<span class="demo-btn"><a href="<?php echo esc_url( BOOKS_PRINTING_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'books-printing'); ?></a>
					</span>
					<span class="doc-btn"><a href="<?php echo esc_url( BOOKS_PRINTING_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Theme Bundle', 'books-printing'); ?></a>
					</span>
				</div>
				<hr>
				<div class="premium-coupon">
					<div class="premium-features">
						<h3><?php esc_html_e('premium Features', 'books-printing'); ?></h3>
						<ul>
							<li><?php esc_html_e( 'Multilingual', 'books-printing' ); ?></li>
							<li><?php esc_html_e( 'Drag and drop features', 'books-printing' ); ?></li>
							<li><?php esc_html_e( 'Zero Coding Required', 'books-printing' ); ?></li>
							<li><?php esc_html_e( 'Mobile Friendly Layout', 'books-printing' ); ?></li>
							<li><?php esc_html_e( 'Responsive Layout', 'books-printing' ); ?></li>
							<li><?php esc_html_e( 'Unique Designs', 'books-printing' ); ?></li>
						</ul>
					</div>
					<div class="coupon-box">
						<h3><?php esc_html_e('Use Coupon Code', 'books-printing'); ?></h3>
						<a class="coupon-btn" href="<?php echo esc_url( BOOKS_PRINTING_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('UPGRADE NOW', 'books-printing'); ?></a>
						<div class="coupon-container">
							<h3><?php esc_html_e( 'elemento20', 'books-printing' ); ?></h3>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

<?php } ?>