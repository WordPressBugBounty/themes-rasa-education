<?php
/**
 * Rasa Education main admin class
 *
 * @package Rasa Education
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class rasa_education_Admin_Main
 */
class rasa_education_Notice {
    public $theme_name;

    /**
     * Rasa Education Notice constructor.
     */
    public function __construct() {

        global $admin_main_class;

        add_action( 'admin_enqueue_scripts', array( $this, 'rasa_education_enqueue_scripts' ) );

        add_action( 'wp_loaded', array( $this, 'rasa_education_hide_welcome_notices' ) );
        add_action( 'wp_loaded', array( $this, 'rasa_education_welcome_notice' ) );


        add_action( 'wp_ajax_rasa_education_activate_plugin', array( $admin_main_class, 'rasa_education_activate_demo_importer_plugin' ) );
        add_action( 'wp_ajax_rasa_education_install_plugin', array( $admin_main_class, 'rasa_education_install_demo_importer_plugin' ) );

        add_action( 'wp_ajax_rasa_education_install_free_plugin', array( $admin_main_class, 'rasa_education_install_free_plugin' ) );
        add_action( 'wp_ajax_rasa_education_activate_free_plugin', array( $admin_main_class, 'rasa_education_activate_free_plugin' ) );

        //theme details
        $theme = wp_get_theme();
        $this->theme_name = $theme->get( 'Name' );
    }

    /**
     * Localize array for import button AJAX request.
     */
    public function rasa_education_enqueue_scripts() {
        wp_enqueue_style( 'rasa-education-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin.css', array(), 20151215 );

        wp_enqueue_script( 'rasa-education-plugin-install-helper', get_template_directory_uri() . '/inc/admin/assets/js/plugin-handle.js', array( 'jquery' ), 20151215 );

        $demo_importer_plugin = WP_PLUGIN_DIR . '/creativ-demo-importer/creativ-demo-importer.php';
        if ( ! file_exists( $demo_importer_plugin ) ) {
            $action = 'install';
        } elseif ( file_exists( $demo_importer_plugin ) && !is_plugin_active( 'creativ-demo-importer/creativ-demo-importer.php' ) ) {
            $action = 'activate';
        } else {
            $action = 'redirect';
        }

        wp_localize_script( 'rasa-education-plugin-install-helper', 'ogAdminObject',
            array(
                'ajax_url'      => esc_url( admin_url( 'admin-ajax.php' ) ),
                '_wpnonce'      => wp_create_nonce( 'rasa_education_plugin_install_nonce' ),
                'buttonStatus'  => esc_html( $action )
            )
        );
    }

    /**
     * Add admin welcome notice.
     */
    public function rasa_education_welcome_notice() {

        if ( isset( $_GET['activated'] ) ) {
            update_option( 'rasa_education_admin_notice_welcome', true );
        }

        $welcome_notice_option = get_option( 'rasa_education_admin_notice_welcome' );

        // Let's bail on theme activation.
        if ( $welcome_notice_option ) {
            add_action( 'admin_notices', array( $this, 'rasa_education_welcome_notice_html' ) );
        }
    }

    /**
     * Hide a notice if the GET variable is set.
     */
    public static function rasa_education_hide_welcome_notices() {
        if ( isset( $_GET['rasa-education-hide-welcome-notice'] ) && isset( $_GET['_rasa_education_welcome_notice_nonce'] ) ) {
            if ( ! wp_verify_nonce( $_GET['_rasa_education_welcome_notice_nonce'], 'rasa_education_hide_welcome_notices_nonce' ) ) {
                wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'rasa-education' ) );
            }

            if ( ! current_user_can( 'manage_options' ) ) {
                wp_die( esc_html__( 'Cheat in &#8217; huh?', 'rasa-education' ) );
            }

            $hide_notice = sanitize_text_field( $_GET['rasa-education-hide-welcome-notice'] );
            update_option( 'rasa_education_admin_notice_' . $hide_notice, false );
        }
    }

    /**
     * function to display welcome notice section
     */
    public function rasa_education_welcome_notice_html() {
        $current_screen = get_current_screen();

        if ( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ) {
            return;
        }
        ?>
        <div id="rasa-education-welcome-notice" class="rasa-education-welcome-notice-wrapper updated notice">
            <a class="rasa-education-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'rasa-education-hide-welcome-notice', 'welcome' ) ), 'rasa_education_hide_welcome_notices_nonce', '_rasa_education_welcome_notice_nonce' ) ); ?>">
                <span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'rasa-education' ); ?>
            </a>
            <div class="rasa-education-welcome-title-wrapper">
                <h2 class="notice-title"><?php esc_html_e( 'Congratulations!', 'rasa-education' ); ?></h2>
                <p class="notice-description">
                    <?php
                        printf( esc_html__( '%1$s is now installed and ready to use. Clicking on Get started with Rasa Education will install and activate Creativ Demo Importer Plugin.', 'rasa-education' ), $this->theme_name );
                    ?>
                </p>
            </div><!-- .rasa-education-welcome-title-wrapper -->
            <div class="welcome-notice-details-wrapper">

                <div class="notice-detail-wrap general">
                    
                    <div class="general-info-links">
                        <div class="buttons-wrap">
                            <button class="rasa-education-get-started button button-primary button-hero" data-done="<?php esc_attr_e( 'Done!', 'rasa-education' ); ?>" data-process="<?php esc_attr_e( 'Processing', 'rasa-education' ); ?>" data-redirect="<?php echo esc_url( wp_nonce_url( add_query_arg( 'rasa-education-hide-welcome-notice', 'welcome', admin_url( 'admin.php' ).'?page=ct-options' ) , 'rasa_education_hide_welcome_notices_nonce', '_rasa_education_welcome_notice_nonce' ) ); ?>">
                                <?php printf( esc_html__( 'Get started with %1$s', 'rasa-education' ), esc_html( $this->theme_name ) ); ?>
                            </button>
                        </div><!-- .buttons-wrap -->
                    </div><!-- .general-info-links -->
                </div><!-- .notice-detail-wrap.general -->

            </div><!-- .welcome-notice-details-wrapper -->
        </div><!-- .rasa-education-welcome-notice-wrapper -->
<?php
    }
}
new rasa_education_Notice();