<?php
/**
 * Wizard
 *
 * @package Business_Classified_Ads_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Business_Classified_Ads_Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $business_classified_ads_theme_name = '';
	protected $business_classified_ads_theme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $business_classified_ads_page_slug = '';
	protected $business_classified_ads_page_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $business_classified_ads_plugin_url = '';

	public $business_classified_ads_plugin_path;
	public $parent_slug;
	
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;
	
	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	
	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {
	
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['business_classified_ads_page_slug'] ) ) {
			$this->business_classified_ads_page_slug = esc_attr( $config['business_classified_ads_page_slug'] );
		}
		if( isset( $config['business_classified_ads_page_title'] ) ) {
			$this->business_classified_ads_page_title = esc_attr( $config['business_classified_ads_page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}
		
		$this->business_classified_ads_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->business_classified_ads_plugin_path );
		$this->business_classified_ads_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$business_classified_ads_current_theme = wp_get_theme();
		$this->business_classified_ads_theme_title = $business_classified_ads_current_theme->get( 'Name' );
		$this->business_classified_ads_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $business_classified_ads_current_theme->get( 'Name' ) ) );
		$this->business_classified_ads_page_slug = apply_filters( $this->business_classified_ads_theme_name . '_theme_setup_wizard_business_classified_ads_page_slug', $this->business_classified_ads_theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->business_classified_ads_theme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {
		
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_business_classified_ads_setup_widgets', array( $this, 'business_classified_ads_setup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'business-classified-ads-homepage-setup-style', get_template_directory_uri() . '/inc/homepage-setup/assets/css/homepage-setup-style.css');
		wp_register_script( 'business-classified-ads-homepage-setup-script', get_template_directory_uri() . '/inc/homepage-setup/assets/js/homepage-setup-script.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'business-classified-ads-homepage-setup-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'business-classified-ads' )
			)
		);
		wp_enqueue_script( 'business-classified-ads-homepage-setup-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}
			
	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}
	
	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->business_classified_ads_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->business_classified_ads_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}
	
	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->business_classified_ads_page_title ), esc_html( $this->business_classified_ads_page_title ), 'manage_options', $this->business_classified_ads_page_slug, array( $this, 'wizard_page' ) );
	}
	
	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() { 
		tgmpa_load_bulk_installer();

		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( esc_html__( 'Failed to find TGM', 'business-classified-ads' ) );
		}

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$business_classified_ads_theme = wp_get_theme();
		$business_classified_ads_theme_title = $business_classified_ads_theme->get( 'Name' );
		$business_classified_ads_theme_version = $business_classified_ads_theme->get( 'Version' );

		?>
		<div class="wrap">
			<?php
				printf( '<h1>%s %s</h1>', esc_html( $business_classified_ads_theme_title ), esc_html( '(Version :- ' . $business_classified_ads_theme_version . ')' ) );
			?>
			<div class="homepage-setup">
				<div class="homepage-setup-theme-bundle">
					<div class="homepage-setup-theme-bundle-one">
						<h1><?php echo esc_html__( 'WP Theme Bundle', 'business-classified-ads' ); ?></h1>
						<p><?php echo wp_kses_post( 'Get <span>15% OFF</span> on all WordPress themes! Use code <span>"BNDL15OFF"</span> at checkout. Limited time offer!' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-two">
						<p><?php echo wp_kses_post( 'Extra <span>15%</span> OFF' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-three">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/bundle-banner.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'business-classified-ads' ); ?>">
					</div>
					<div class="homepage-setup-theme-bundle-four">
						<p><?php echo wp_kses_post( '<span>$2795</span>$69' ); ?></p>
						<a target="_blank" href="<?php echo esc_url( BUSINESS_CLASSIFIED_ADS_BUNDLE_BUTTON ); ?>"><?php echo esc_html__( 'SHOP NOW', 'business-classified-ads' ); ?> <span class="dashicons dashicons-arrow-right-alt2"></span></a>
					</div>
				</div>
			</div>
			
			<div class="card whizzie-wrap">
				<div class="demo_content_image">
					<div class="demo_content">
						<?php
							$business_classified_ads_steps = $this->get_steps();
							echo '<ul class="whizzie-menu">';
							foreach ( $business_classified_ads_steps as $business_classified_ads_step ) {
								$class = 'step step-' . esc_attr( $business_classified_ads_step['id'] );
								echo '<li data-step="' . esc_attr( $business_classified_ads_step['id'] ) . '" class="' . esc_attr( $class ) . '">';
								printf( '<h2>%s</h2>', esc_html( $business_classified_ads_step['title'] ) );

								$content = call_user_func( array( $this, $business_classified_ads_step['view'] ) );
								if ( isset( $content['summary'] ) ) {
									printf(
										'<div class="summary">%s</div>',
										wp_kses_post( $content['summary'] )
									);
								}
								if ( isset( $content['detail'] ) ) {
									printf(
										'<div class="detail">%s</div>',
										wp_kses_post( $content['detail'] )
									);
								}
								if ( isset( $business_classified_ads_step['button_text'] ) && $business_classified_ads_step['button_text'] ) {
									printf( 
										'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
										esc_attr( $business_classified_ads_step['callback'] ),
										esc_attr( $business_classified_ads_step['id'] ),
										esc_html( $business_classified_ads_step['button_text'] )
									);
								}
								echo '</li>';
							}
							echo '</ul>';
						?>
						
						<ul class="whizzie-nav">
							<?php
							$step_number = 1;	
							foreach ( $business_classified_ads_steps as $business_classified_ads_step ) {
								echo '<li class="nav-step-' . esc_attr( $business_classified_ads_step['id'] ) . '">';
								echo '<span class="step-number">' . esc_html( $step_number ) . '</span>';
								echo '</li>';
								$step_number++;
							}
							?>
							<div class="blank-border"></div>
						</ul>

						<div class="homepage-setup-links">
							<div class="homepage-setup-links buttons">
								<a href="<?php echo esc_url( BUSINESS_CLASSIFIED_ADS_LITE_DOCS_PRO ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Free Documentation', 'business-classified-ads' ); ?></a>
								<a href="<?php echo esc_url( BUSINESS_CLASSIFIED_ADS_BUY_NOW ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Get Premium', 'business-classified-ads' ); ?></a>
								<a href="<?php echo esc_url( BUSINESS_CLASSIFIED_ADS_DEMO_PRO ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Premium Demo', 'business-classified-ads' ); ?></a>
								<a href="<?php echo esc_url( BUSINESS_CLASSIFIED_ADS_SUPPORT_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Support Forum', 'business-classified-ads' ); ?></a>
							</div>
						</div> <!-- .demo_image -->

						<div class="step-loading"><span class="spinner"></span></div>
					</div> <!-- .demo_content -->

					<div class="homepage-setup-image">
						<div class="homepage-setup-theme-buynow">
							<div class="homepage-setup-theme-buynow-one">
								<h1><?php echo wp_kses_post( 'Classified Ads<br>WordPress Theme' ); ?></h1>
								<p><?php echo wp_kses_post( '<span>25%<br>Off</span> SHOP NOW' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-two">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/business-classified-ads.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'business-classified-ads' ); ?>">
							</div>
							<div class="homepage-setup-theme-buynow-three">
								<p><?php echo wp_kses_post( 'Get <span>25% OFF</span> on Premium Classified Ads WordPress Theme Use code <span>"NYTHEMES25"</span> at checkout.' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-four">
								<a target="_blank" href="<?php echo esc_url( BUSINESS_CLASSIFIED_ADS_BUY_NOW ); ?>"><?php echo esc_html__( 'Upgrade To Pro With Just $40', 'business-classified-ads' ); ?></a>
							</div>
						</div>
					</div> <!-- .demo_image -->

				</div> <!-- .demo_content_image -->
			</div> <!-- .whizzie-wrap -->
		</div> <!-- .wrap -->
		<?php
	}


	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$business_classified_ads_dev_steps = $this->config_steps;
		$business_classified_ads_steps = array( 
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Install and Activate Essential Plugins', 'business-classified-ads' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'business-classified-ads' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Setup Home Page', 'business-classified-ads' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'business_classified_ads_install_widgets',
				'button_text'	=> __( 'Start Home Page Setup', 'business-classified-ads' ),
				'can_skip'		=> false
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'Customize Your Site', 'business-classified-ads' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $business_classified_ads_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from homepage-setup-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $business_classified_ads_dev_steps as $business_classified_ads_dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $business_classified_ads_dev_step['id'] ) ) {
					$id = $business_classified_ads_dev_step['id'];
					if( isset( $business_classified_ads_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $business_classified_ads_dev_step[$element] ) ) {
								$business_classified_ads_steps[$id][$element] = $business_classified_ads_dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $business_classified_ads_steps;
	}

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); 
		
		// Add plugin name and type at the top
		$content['detail'] = '<div class="plugin-info">';
		$content['detail'] .= '<p><strong>Plugin</strong></p>';
		$content['detail'] .= '<p><strong>Type</strong></p>';
		$content['detail'] .= '</div>';
		
		// The detail element is initially hidden from the user
		$content['detail'] .= '<ul class="whizzie-do-plugins">';
		
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			if ( $slug != 'easy-post-views-count') {
				$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
				$keys = array();
				if ( isset( $plugins['install'][ $slug ] ) ) {
					$keys[] = 'Installation';
				}
				if ( isset( $plugins['update'][ $slug ] ) ) {
					$keys[] = 'Update';
				}
				if ( isset( $plugins['activate'][ $slug ] ) ) {
					$keys[] = 'Activation';
				}
				$content['detail'] .= implode( ' and ', $keys ) . ' required';
				$content['detail'] .= '</span></li>';
			}
		}
		
		$content['detail'] .= '</ul>';
		
		return $content;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?> <?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="business-classified-ads-demo-setup-guid">
			<div class="customize_div">
				<div class="customize_div finish">
					<div class="customize_div finish btns">
						<h3><?php echo esc_html( 'Your Site Is Ready To View' ); ?></h3>
						<div class="btnsss">
							<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary">
								<?php esc_html_e( 'View Your Site', 'business-classified-ads' ); ?>
							</a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Your Site', 'business-classified-ads' ); ?>
							</a>
							<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary">
								<?php esc_html_e( 'Finsh', 'business-classified-ads' ); ?>
							</a>
						</div>
					</div>
					<div class="business-classified-ads-setup-finish">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>"/>
					</div>
				</div>
			</div>
		</div>
	<?php }

	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}
	
	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','business-classified-ads' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();
		
		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','business-classified-ads' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','business-classified-ads' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','business-classified-ads' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','business-classified-ads' ) ) );
		}
		exit;
	}


	public function business_classified_ads_customizer_nav_menu() {

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Business Classified Ads Primary Menu -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

		$business_classified_ads_themename = 'Business Classified Ads';
		$business_classified_ads_menuname = $business_classified_ads_themename . ' Primary Menu';
		$business_classified_ads_menulocation = 'business-classified-ads-primary-menu';
		$business_classified_ads_menu_exists = wp_get_nav_menu_object($business_classified_ads_menuname);

		if (!$business_classified_ads_menu_exists) {
			$business_classified_ads_menu_id = wp_create_nav_menu($business_classified_ads_menuname);

			// Home
			wp_update_nav_menu_item($business_classified_ads_menu_id, 0, array(
				'menu-item-title' => __('Home', 'business-classified-ads'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$business_classified_ads_page_about = get_page_by_path('about');
			if($business_classified_ads_page_about){
				wp_update_nav_menu_item($business_classified_ads_menu_id, 0, array(
					'menu-item-title' => __('About', 'business-classified-ads'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($business_classified_ads_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$business_classified_ads_page_services = get_page_by_path('services');
			if($business_classified_ads_page_services){
				wp_update_nav_menu_item($business_classified_ads_menu_id, 0, array(
					'menu-item-title' => __('Services', 'business-classified-ads'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($business_classified_ads_page_services),
					'menu-item-status' => 'publish'
				));
			}

			// Shop Page (WooCommerce)
			if (class_exists('WooCommerce')) {
				$business_classified_ads_shop_page_id = wc_get_page_id('shop');
				if ($business_classified_ads_shop_page_id) {
					wp_update_nav_menu_item($business_classified_ads_menu_id, 0, array(
						'menu-item-title' => __('Shop', 'business-classified-ads'),
						'menu-item-classes' => 'shop',
						'menu-item-url' => get_permalink($business_classified_ads_shop_page_id),
						'menu-item-status' => 'publish'
					));
				}
			}

			// Blog
			$business_classified_ads_page_blog = get_page_by_path('blog');
			if($business_classified_ads_page_blog){
				wp_update_nav_menu_item($business_classified_ads_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'business-classified-ads'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($business_classified_ads_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// 404 Page
			$business_classified_ads_notfound = get_page_by_path('404 Page');
			if($business_classified_ads_notfound){
				wp_update_nav_menu_item($business_classified_ads_menu_id, 0, array(
					'menu-item-title' => __('404 Page', 'business-classified-ads'),
					'menu-item-classes' => '404',
					'menu-item-url' => get_permalink($business_classified_ads_notfound),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($business_classified_ads_menulocation)) {
				$business_classified_ads_locations = get_theme_mod('nav_menu_locations');
				$business_classified_ads_locations[$business_classified_ads_menulocation] = $business_classified_ads_menu_id;
				set_theme_mod('nav_menu_locations', $business_classified_ads_locations);
			}
		}
	}

	
	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function business_classified_ads_setup_widgets(){

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- MENUS PAGES -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/
		
			// Creation of home page //
			$business_classified_ads_home_content = '';
			$business_classified_ads_home_title = 'Home';
			$business_classified_ads_home = array(
					'post_type' => 'page',
					'post_title' => $business_classified_ads_home_title,
					'post_content'  => $business_classified_ads_home_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$business_classified_ads_home_id = wp_insert_post($business_classified_ads_home);

			add_post_meta( $business_classified_ads_home_id, '_wp_page_template', 'frontpage.php' );

			$business_classified_ads_home = get_page_by_path( 'Home' );
			update_option( 'page_on_front', $business_classified_ads_home->ID );
			update_option( 'show_on_front', 'page' );

			// Creation of blog page //
			$business_classified_ads_blog_title = 'Blog';
			$business_classified_ads_blog_check = get_page_by_path('blog');
			if (!$business_classified_ads_blog_check) {
				$business_classified_ads_blog = array(
					'post_type'    => 'page',
					'post_title'   => $business_classified_ads_blog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$business_classified_ads_blog_id = wp_insert_post($business_classified_ads_blog);

				if (!is_wp_error($business_classified_ads_blog_id)) {
					update_option('page_for_posts', $business_classified_ads_blog_id);
				}
			}

			// Creation of about page //
			$business_classified_ads_about_title = 'About';
			$business_classified_ads_about_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$business_classified_ads_about_check = get_page_by_path('about');
			if (!$business_classified_ads_about_check) {
				$business_classified_ads_about = array(
					'post_type'    => 'page',
					'post_title'   => $business_classified_ads_about_title,
					'post_content'   => $business_classified_ads_about_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'about'
				);
				wp_insert_post($business_classified_ads_about);
			}

			// Creation of services page //
			$business_classified_ads_services_title = 'Services';
			$business_classified_ads_services_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$business_classified_ads_services_check = get_page_by_path('services');
			if (!$business_classified_ads_services_check) {
				$business_classified_ads_services = array(
					'post_type'    => 'page',
					'post_title'   => $business_classified_ads_services_title,
					'post_content'   => $business_classified_ads_services_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'services'
				);
				wp_insert_post($business_classified_ads_services);
			}

			// Creation of 404 page //
			$business_classified_ads_notfound_title = '404 Page';
			$business_classified_ads_notfound = array(
				'post_type'   => 'page',
				'post_title'  => $business_classified_ads_notfound_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug'   => '404'
			);
			$business_classified_ads_notfound_id = wp_insert_post($business_classified_ads_notfound);
			add_post_meta($business_classified_ads_notfound_id, '_wp_page_template', '404.php');



			/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- SLIDER POST -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

				$business_classified_ads_slider_title = array('Your Trusted Partner To Find The Right Services');
				for($business_classified_ads_i=1;$business_classified_ads_i<=1;$business_classified_ads_i++){

					$business_classified_ads_title = $business_classified_ads_slider_title[$business_classified_ads_i-1];
					$business_classified_ads_content = 'Posting an ad is free and easy - it only takes a few simple steps! Select the right category and publish your classified ad for free.';

					// Create post object
					$business_classified_ads_my_post = array(
							'post_title'    => wp_strip_all_tags( $business_classified_ads_title ),
							'post_content'  => $business_classified_ads_content,
							'post_status'   => 'publish',
							'post_type'     => 'post',
					);
					// Insert the post into the database
					$business_classified_ads_post_id = wp_insert_post( $business_classified_ads_my_post );

					wp_set_object_terms($business_classified_ads_post_id, 'Slider', 'category', true);

					wp_set_object_terms($business_classified_ads_post_id, 'Slider', 'post_tag', true);

					$business_classified_ads_image_url = get_template_directory_uri().'/inc/homepage-setup/assets/homepage-setup-images/slider-img'.$business_classified_ads_i.'.png';

					$business_classified_ads_image_name= 'slider-img'.$business_classified_ads_i.'.png';
					$upload_dir       = wp_upload_dir();
					// Set upload folder
					$business_classified_ads_image_data       = file_get_contents($business_classified_ads_image_url);
					// Get image data
					$unique_file_name = wp_unique_filename( $upload_dir['path'], $business_classified_ads_image_name );

					$business_classified_ads_filename = basename( $unique_file_name ); 
					
					// Check folder permission and define file location
					if( wp_mkdir_p( $upload_dir['path'] ) ) {
							$business_classified_ads_file = $upload_dir['path'] . '/' . $business_classified_ads_filename;
					} else {
							$business_classified_ads_file = $upload_dir['basedir'] . '/' . $business_classified_ads_filename;
					}
					// Create the image  file on the server
					// Generate unique name
					if ( ! function_exists( 'WP_Filesystem' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					
					WP_Filesystem();
					global $wp_filesystem;
					
					if ( ! $wp_filesystem->put_contents( $business_classified_ads_file, $business_classified_ads_image_data, FS_CHMOD_FILE ) ) {
						wp_die( 'Error saving file!' );
					}
					// Check image file type
					$wp_filetype = wp_check_filetype( $business_classified_ads_filename, null );
					// Set attachment data
					$business_classified_ads_attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_title'     => sanitize_file_name( $business_classified_ads_filename ),
							'post_content'   => '',
							'post_type'     => 'post',
							'post_status'    => 'inherit'
					);
					// Create the attachment
					$business_classified_ads_attach_id = wp_insert_attachment( $business_classified_ads_attachment, $business_classified_ads_file, $business_classified_ads_post_id );
					// Include image.php
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					// Define attachment metadata
					$business_classified_ads_attach_data = wp_generate_attachment_metadata( $business_classified_ads_attach_id, $business_classified_ads_file );
					// Assign metadata to attachment
						wp_update_attachment_metadata( $business_classified_ads_attach_id, $business_classified_ads_attach_data );
					// And finally assign featured image to post
					set_post_thumbnail( $business_classified_ads_post_id, $business_classified_ads_attach_id );

	 			}


			/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- SECOND SECTION POST -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

				$business_classified_ads_second_section_title = array('Lorem ipsum dolor sit met elit, consectetur...','Lorem ipsum dolor sit met elit, consectetur...','Lorem ipsum dolor sit met elit, consectetur...');
				for($business_classified_ads_i=1;$business_classified_ads_i<=3;$business_classified_ads_i++){

					$business_classified_ads_title = $business_classified_ads_second_section_title[$business_classified_ads_i-1];
					$business_classified_ads_content = 'Lorem ipsum dolor sit met elit.';

					// Create post object
					$business_classified_ads_my_post = array(
							'post_title'    => wp_strip_all_tags( $business_classified_ads_title ),
							'post_content'  => $business_classified_ads_content,
							'post_status'   => 'publish',
							'post_type'     => 'post',
					);
						// Insert the post into the database
					$business_classified_ads_post_id = wp_insert_post( $business_classified_ads_my_post );

					wp_set_object_terms($business_classified_ads_post_id, 'Second', 'category', true);

					wp_set_object_terms($business_classified_ads_post_id, 'Second', 'post_tag', true);

					$business_classified_ads_image_url = get_template_directory_uri().'/inc/homepage-setup/assets/homepage-setup-images/post-img'.$business_classified_ads_i.'.png';

					$business_classified_ads_image_name= 'post-img'.$business_classified_ads_i.'.png';
					$upload_dir       = wp_upload_dir();
					// Set upload folder
					$business_classified_ads_image_data       = file_get_contents($business_classified_ads_image_url);
					// Get image data
					$unique_file_name = wp_unique_filename( $upload_dir['path'], $business_classified_ads_image_name );

					$business_classified_ads_filename = basename( $unique_file_name ); 
					
					// Check folder permission and define file location
					if( wp_mkdir_p( $upload_dir['path'] ) ) {
							$business_classified_ads_file = $upload_dir['path'] . '/' . $business_classified_ads_filename;
					} else {
							$business_classified_ads_file = $upload_dir['basedir'] . '/' . $business_classified_ads_filename;
					}
					// Create the image  file on the server
					// Generate unique name
					if ( ! function_exists( 'WP_Filesystem' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					
					WP_Filesystem();
					global $wp_filesystem;
					
					if ( ! $wp_filesystem->put_contents( $business_classified_ads_file, $business_classified_ads_image_data, FS_CHMOD_FILE ) ) {
						wp_die( 'Error saving file!' );
					}
					// Check image file type
					$wp_filetype = wp_check_filetype( $business_classified_ads_filename, null );
					// Set attachment data
					$business_classified_ads_attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_title'     => sanitize_file_name( $business_classified_ads_filename ),
							'post_content'   => '',
							'post_type'     => 'post',
							'post_status'    => 'inherit'
					);
					// Create the attachment
					$business_classified_ads_attach_id = wp_insert_attachment( $business_classified_ads_attachment, $business_classified_ads_file, $business_classified_ads_post_id );
					// Include image.php
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					// Define attachment metadata
					$business_classified_ads_attach_data = wp_generate_attachment_metadata( $business_classified_ads_attach_id, $business_classified_ads_file );
					// Assign metadata to attachment
						wp_update_attachment_metadata( $business_classified_ads_attach_id, $business_classified_ads_attach_data );
					// And finally assign featured image to post
					set_post_thumbnail( $business_classified_ads_post_id, $business_classified_ads_attach_id );

				}


			/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Contact Form -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

				$business_classified_ads_cf7_form_data = array(
					'post_title'    => 'Business Classified Ads Contact Form',
					'post_type'     => 'wpcf7_contact_form',
					'post_status'   => 'publish',
				);

				$business_classified_ads_cf7post_id = wp_insert_post($business_classified_ads_cf7_form_data);

				if ($business_classified_ads_cf7post_id) {
					$business_classified_ads_form_content = '[email* enter_address placeholder "Enter Address"]' . "\n" .
									'[tel* phone_number placeholder "Enter Phone Number"]' . "\n" .
									'[text enter_text_here placeholder "Enter Text"]' . "\n" .
									'[submit "Submit"]';

					update_post_meta($business_classified_ads_cf7post_id, '_form', $business_classified_ads_form_content);

					$business_classified_ads_cf7shortcode = '[contact-form-7 id="' . $business_classified_ads_cf7post_id . '" title="Business Classified Ads Contact Form"]';

					set_theme_mod('business_classified_ads_contact_form_shortcode', $business_classified_ads_cf7shortcode);

					echo "Form successfully created with shortcode: " . esc_html($business_classified_ads_cf7shortcode);
				} else {
					echo "Failed to create Contact Form 7 form.";
				}

        
        $this->business_classified_ads_customizer_nav_menu();

	    exit;
	}
}