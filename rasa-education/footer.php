<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rasa Education
 */

/**
 *
 * @hooked rasa_education_footer_start
 */
do_action( 'rasa_education_action_before_footer' );

/**
 * Hooked - rasa_education_footer_top_section -10
 * Hooked - rasa_education_footer_section -20
 */
do_action( 'rasa_education_action_footer' );

/**
 * Hooked - rasa_education_footer_end. 
 */
do_action( 'rasa_education_action_after_footer' );

wp_footer(); ?>

</body>  
</html>