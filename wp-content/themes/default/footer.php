<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<footer id="footer">
</footer>
		
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/site.js"></script>

</div><!--END: WRAPPER-->
<nav id="mobile_menu" class="hide">
	<?php wp_nav_menu(array('container' => '',  'menu_class' => 'mobile-menu', 'menu' => 'Mobile-Menu')); ?>
</nav>
<?php wp_footer(); ?>
</body>
</html>
