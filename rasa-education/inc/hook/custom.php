<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Rasa Education
 */

if( ! function_exists( 'rasa_education_site_branding' ) ) :
/**
* Site Branding
*
* @since 1.0.0
*/
function rasa_education_site_branding() { ?>
        <div class="header-top">
            <div class="wrapper">
                <div class="site-branding">
                    <div class="site-logo">
                        <?php if(has_custom_logo()):?>
                            <?php the_custom_logo();?>
                        <?php endif;?>
                    </div><!-- .site-logo -->

                    <div id="site-identity">
                        <h1 class="site-title">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">  <?php bloginfo( 'name' ); ?></a>
                        </h1>

                        <?php 
                            $rasa_education_description = get_bloginfo( 'description', 'display' );
                            if ( $rasa_education_description || is_customize_preview() ) : ?>
                            <p class="site-description"><?php echo esc_html($rasa_education_description);?></p>
                        <?php endif; ?>
                    </div><!-- #site-identity -->
                </div> <!-- .site-branding -->

                <?php $rasa_education_show_contact_details  = rasa_education_get_option( 'rasa_education_show_contact_details' );

                if( true == rasa_education_get_option('rasa_education_show_contact_details') ) { ?>
                    <div class="site-contact-details clear">
                        <?php
                        $rasa_education_address_one   = rasa_education_get_option( 'rasa_education_address_one' );
                        $rasa_education_address_two   = rasa_education_get_option( 'rasa_education_address_two' );
                        $rasa_education_phone_number  = rasa_education_get_option( 'rasa_education_phone_number' ); 
                        $rasa_education_opening_time  = rasa_education_get_option( 'rasa_education_opening_time' ); 
                        $rasa_education_email_id      = rasa_education_get_option( 'rasa_education_email_id' ); 
                        $rasa_education_support_text  = rasa_education_get_option( 'rasa_education_support_text' ); 

                        ?>

                        <button type="button" class="top-header-menu-toggle">
                            <i class="fa-solid fa-bars-staggered open-icon"></i>
                            <i class="fa-solid fa-xmark close-icon"></i>
                        </button>

                        <ul>
                            <?php if( !empty( $rasa_education_address_one || $rasa_education_address_two ) ):?>
                                <li>
                                    <i class="fa-regular fa-map"></i>
                                    <div class="list-details">
                                        <h2><?php echo esc_html( $rasa_education_address_one ); ?></h2>
                                        <span><?php echo esc_html( $rasa_education_address_two ); ?></span>
                                    </div><!-- .list-details -->
                                </li>
                            <?php endif;?>

                            <?php if( !empty( $rasa_education_phone_number || $rasa_education_opening_time ) ):?>
                                <li>
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    <div class="list-details">
                                        <h2><?php echo esc_html( $rasa_education_phone_number ); ?></h2>
                                        <span><?php echo esc_html( $rasa_education_opening_time ); ?></span>
                                    </div><!-- .list-details -->
                                </li>
                            <?php endif;?>

                            <?php if( !empty( $rasa_education_email_id || $rasa_education_support_text ) ):?>
                                <li>
                                    <i class="fa-regular fa-envelope"></i>
                                    <div class="list-details">
                                        <h2><?php echo esc_html( $rasa_education_email_id ); ?></h2>
                                        <span><?php echo esc_html( $rasa_education_support_text ); ?></span>
                                    </div><!-- .list-details -->
                                </li>
                            <?php endif;?>
                        </ul>
                    </div><!-- .site-contact-details -->
                <?php } ?>
            </div><!-- .wrapper -->
        </div><!-- .header-top -->

        <div class="header-bottom">
            <div class="wrapper">
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php echo esc_attr__('Primary Menu', 'rasa-education'); ?>">
                    <button type="button" class="menu-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <?php
                    $rasa_education_show_menu_button   = rasa_education_get_option( 'rasa_education_show_menu_button' );
                    $rasa_education_menu_button_text   = rasa_education_get_option( 'rasa_education_menu_button_text' );
                    $rasa_education_menu_button_url    = rasa_education_get_option( 'rasa_education_menu_button_url' );

                    $rasa_education_custom_button = '';
                    if( $rasa_education_show_menu_button ) {
                        $rasa_education_custom_button .= '<li class="custom-menu-item"><a href="'. esc_url( $rasa_education_menu_button_url ) .'" class="btn">'
                                . esc_html( $rasa_education_menu_button_text ) .'</a>
                                </li>';
                    }

                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => 'rasa_education_primary_navigation_fallback',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $rasa_education_custom_button . '</ul>',
                    ) );
                    ?>
                </nav><!-- #site-navigation -->
            </div><!-- .wrapper -->
        </div><!-- .header-bottom -->
<?php }
endif;
add_action( 'rasa_education_action_header', 'rasa_education_site_branding', 10 );

if ( ! function_exists( 'rasa_education_footer_top_section' ) ) :

  /**
   * Top  Footer 
   *
   * @since 1.0.0
   */
  function rasa_education_footer_top_section() {
      $rasa_education_footer_sidebar_data = rasa_education_footer_sidebar_class();
      $rasa_education_footer_sidebar    = $rasa_education_footer_sidebar_data['active_sidebar'];
      $rasa_education_footer_class      = $rasa_education_footer_sidebar_data['class'];
      if ( empty( $rasa_education_footer_sidebar ) ) {
        return;
      }      ?>
      <div class="footer-widgets-area section-gap <?php echo esc_attr( $rasa_education_footer_class ); ?>"> <!-- widget area starting from here -->
          <div class="wrapper">
            <?php
              for ( $i = 1; $i <= 4 ; $i++ ) {
                if ( is_active_sidebar( 'footer-' . $i ) ) {
                ?>
                  <div class="hentry">
                    <?php dynamic_sidebar( 'footer-' . $i ); ?>
                  </div>
                  <?php
                }
              }
            ?>
            </div>
          
      </div> <!-- widget area starting from here -->
    <?php
 }
endif;

add_action( 'rasa_education_action_footer', 'rasa_education_footer_top_section', 10 );

if ( ! function_exists( 'rasa_education_footer_section' ) ) :

  /**
   * Footer copyright
   *
   * @since 1.0.0
   */
  function rasa_education_footer_section() { ?>
    <div class="site-info">    
        <?php 
            $rasa_education_copyright_footer = rasa_education_get_option('copyright_text'); 
            if ( ! empty( $rasa_education_copyright_footer ) ) {
                $rasa_education_copyright_footer = wp_kses_data( $rasa_education_copyright_footer );
            }
            // Powered by content.
            $rasa_education_powered_by_text = sprintf( __( ' Theme Rasa Education by %s', 'rasa-education' ), '<a target="_blank" rel="designer" href="'. esc_url( 'http://creativthemes.com/' ) .'">Creativ Themes</a>' );
        ?>
        <div class="wrapper">
            <span class="copy-right"><?php echo esc_html($rasa_education_copyright_footer);?><?php echo $rasa_education_powered_by_text;?></span>
        </div><!-- .wrapper --> 
    </div> <!-- .site-info -->
    
  <?php }

endif;
add_action( 'rasa_education_action_footer', 'rasa_education_footer_section', 20 );

if ( ! function_exists( 'rasa_education_footer_sidebar_class' ) ) :
  /**
   * Count the number of footer sidebars to enable dynamic classes for the footer
   *
   * @since rasa_education 0.1
   */
  function rasa_education_footer_sidebar_class() {
    $rasa_education_data = array();
    $rasa_education_active_sidebar = array();
      $rasa_education_count = 0;

      if ( is_active_sidebar( 'footer-1' ) ) {
        $rasa_education_active_sidebar[]   = 'footer-1';
          $rasa_education_count++;
      }

      if ( is_active_sidebar( 'footer-2' ) ){
        $rasa_education_active_sidebar[]   = 'footer-2';
          $rasa_education_count++;
    }

      if ( is_active_sidebar( 'footer-3' ) ){
        $rasa_education_active_sidebar[]   = 'footer-3';
          $rasa_education_count++;
      }

      if ( is_active_sidebar( 'footer-4' ) ){
        $rasa_education_active_sidebar[]   = 'footer-4';
          $rasa_education_count++;
      }

      $rasa_education_class = '';

      switch ( $rasa_education_count ) {
          case '1':
            $rasa_education_class = 'col-1';
            break;
          case '2':
            $rasa_education_class = 'col-2';
            break;
          case '3':
            $rasa_education_class = 'col-3';
            break;
            case '4':
            $rasa_education_class = 'col-4';
            break;
      }

    $rasa_education_data['active_sidebar'] = $rasa_education_active_sidebar;
    $rasa_education_data['class']        = $rasa_education_class;

      return $rasa_education_data;
  }
endif;

if ( ! function_exists( 'rasa_education_excerpt_length' ) ) :

  /**
   * Implement excerpt length.
   *
   * @since 1.0.0
   *
   * @param int $length The number of words.
   * @return int Excerpt length.
   */
  function rasa_education_excerpt_length( $length ) {

    if ( is_admin() ) {
      return $rasa_education_length;
    }

    $rasa_education_excerpt_length = rasa_education_get_option( 'excerpt_length' );

    if ( absint( $rasa_education_excerpt_length ) > 0 ) {
      $rasa_education_length = absint( $rasa_education_excerpt_length );
    }

    return $rasa_education_length;
  }

endif;

add_filter( 'excerpt_length', 'rasa_education_excerpt_length', 999 );

if( ! function_exists( 'rasa_education_banner_header' ) ) :
    /**
     * Page Header
    */
    function rasa_education_banner_header() { ?>
        <?php if( true == rasa_education_get_option('enable_frontpage_header_image') && ( is_home() || is_front_page() ) ) { ?>
            <div id="header-image">
                <?php the_custom_header_markup(); ?>
                <header class='page-header'>
                    <div class="wrapper">
                        <?php rasa_education_banner_title();?>
                    </div><!-- .wrapper -->
                </header>
            </div><!-- #header-image -->
        <?php } ?>

        <?php if( !is_home() && !is_front_page() ) { ?>
            <div id="header-image">
                <?php the_custom_header_markup(); ?>
                <header class='page-header'>
                    <div class="wrapper">
                        <?php rasa_education_banner_title();?>
                    </div><!-- .wrapper -->
                </header>
            </div><!-- #header-image -->
        <?php } ?>

        <?php
    }
endif;
add_action( 'rasa_education_banner_header', 'rasa_education_banner_header', 10 );

if( ! function_exists( 'rasa_education_banner_title' ) ) :
/**
 * Page Header
*/
function rasa_education_banner_title(){ 
    if ( ( is_front_page() && is_home() ) || is_home() ){ 
        $rasa_education_your_latest_posts_title = rasa_education_get_option( 'your_latest_posts_title' );?>
        <h2 class="page-title"><?php echo esc_html($rasa_education_your_latest_posts_title); ?></h2><?php
    }

    if( is_singular() ) {
        the_title( '<h2 class="page-title">', '</h2>' );
    }       

    if( is_archive() ){
        the_archive_description( '<div class="archive-description">', '</div>' );
        the_archive_title( '<h2 class="page-title">', '</h2>' );
    }

    if( is_search() ){ ?>
        <h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'rasa-education' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
    <?php }
    
    if( is_404() ) {
        echo '<h2 class="page-title">' . esc_html__( 'Error 404', 'rasa-education' ) . '</h2>';
    }
}
endif;

if ( ! function_exists( 'rasa_education_posts_tags' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function rasa_education_posts_tags() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() && has_tag() ) { ?>
                <div class="tags-links">

                    <?php /* translators: used between list items, there is a space after the comma */
                    $rasa_education_tags = get_the_tags();
                    if ( $rasa_education_tags ) {

                        foreach ( $rasa_education_tags as $tag ) {
                            echo '<span><a href="' . esc_url( get_tag_link( $tag->term_id ) ) .'">' . esc_html( $tag->name ) . '</a></span>'; // WPCS: XSS OK.
                        }
                    } ?>
                </div><!-- .tags-links -->
        <?php } 
    }
endif;