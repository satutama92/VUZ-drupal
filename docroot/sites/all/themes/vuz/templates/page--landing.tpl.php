<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */
?>
<?php include "./" . path_to_theme() . "/templates/page--header.tpl.php"; ?>
<div class="greenBackground">
    <picture class="logo">
      <source media="(max-width: 480px)" srcset="../sites/all/themes/vuz/image/logo-verzekeruzelf-mobile.png">
      <source media="(max-width: 978x)" srcset="../sites/all/themes/vuz/image/logo-verzekeruzelf-normal.png">
      <source media="(max-width: 979px)" srcset="../sites/all/themes/vuz/image/logo-verzekeruzelf-wide.png">
      <img class="img-responsive" src="../sites/all/themes/vuz/image/logo-verzekeruzelf-wide.png" alt="Logo Verzekeruzelf">
    </picture>
  </div>
</header>
<div class="main-container <?php print $container_class; ?>">

  <div class="row">

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>

    <section<?php print $content_column_class; ?>>
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
<!--       <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?> -->
      <a id="main-content"></a>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
    </section>

    <section>
      <div class="container">  
        <div class="col-xs-12"><h1 class="blue"><?php print render($page['pageTitle']); ?></h1></div>
        <div class="col-xs-12 col-sm-6"><?php print render($page['content']); ?></div>
        <?php if (!empty($page['2ndColumnContent'])): ?>
          <div class="col-xs-12 col-sm-6"><?php print render($page['2ndColumnContent']); ?></div>
        <?php endif;?>
        <?php if (!empty($page['pageContent3'])): ?>
          <div class="col-xs-12"><?php print render($page['pageContent3']); ?></div>
        <?php endif;?>
        <?php if (!empty($page['pageContent4'])): ?>
          <div class="col-xs-12 col-sm-6"><?php print render($page['pageContent4']); ?></div>
        <?php endif;?>
        <?php if (!empty($page['pageContent5'])): ?>
          <div class="col-xs-12 col-sm-6"><?php print render($page['pageContent5']); ?></div>
        <?php endif;?>
        <?php if (!empty($page['pageContent6'])): ?>
          <div class="col-xs-12"><?php print render($page['pageContent6']); ?></div>
        <?php endif;?>
      </div>
    </section>

    <section class="blue">
      <div class=" container">
        <?php if (!empty($page['blueContentTitle']) ): ?>
          <div class="col-xs-12"><?php print render($page['blueContentTitle']); ?></div>
        <?php endif; ?> 
        <?php if (!empty($page['productTabelColumn1']) && empty($page['productTabelColumn2'])): ?>
          <div class="col-xs-12 col-md-12 infoColumn"><?php print render($page['productTabelColumn1']); ?></div>
        <?php endif; ?>
        <?php if (!empty($page['productTabelColumn2']) && empty($page['productTabelColumn3'])): ?>
          <div class="col-xs-12 col-sm-6 infoColumn"><?php print render($page['productTabelColumn1']); ?></div>
          <div class="col-xs-12 col-sm-6 infoColumn"><?php print render($page['productTabelColumn2']); ?></div>
        <?php endif; ?>
        <?php if (!empty($page['productTabelColumn3']) && empty($page['productTabelColumn4'])): ?>
          <div class="col-xs-12 col-sm-4 infoColumn"><?php print render($page['productTabelColumn1']); ?></div>
          <div class="col-xs-12 col-sm-4 infoColumn"><?php print render($page['productTabelColumn2']); ?></div>
          <div class="col-xs-12 col-sm-4 infoColumn"><?php print render($page['productTabelColumn3']); ?></div>
        <?php endif; ?>
        <?php if (!empty($page['productTabelColumn4']) && empty($page['productTabelColumn5'])): ?>
          <div class="col-xs-12 col-sm-6 col-md-3 infoColumn"><?php print render($page['productTabelColumn1']); ?></div>
          <div class="col-xs-12 col-sm-6 col-md-3 infoColumn"><?php print render($page['productTabelColumn2']); ?></div>
          <div class="col-xs-12 col-sm-6 col-md-3 infoColumn"><?php print render($page['productTabelColumn3']); ?></div>
          <div class="col-xs-12 col-sm-6 col-md-3 infoColumn"><?php print render($page['productTabelColumn4']); ?></div>
        <?php endif; ?>
        <?php if (!empty($page['productTabelColumn5'])): ?>
          <div class="col-xs-12 col-md-4 infoColumn"><?php print render($page['productTabelColumn1']); ?></div>
          <div class="col-xs-12 col-md-4 infoColumn"><?php print render($page['productTabelColumn2']); ?></div>
          <div class="col-xs-12 col-md-4 infoColumn"><?php print render($page['productTabelColumn3']); ?></div>
          <div class="col-xs-12 col-md-4 infoColumn"><?php print render($page['productTabelColumn4']); ?></div>
          <div class="col-xs-12 col-md-4 infoColumn"><?php print render($page['productTabelColumn5']); ?></div>
        <?php endif; ?> 
        <picture class="hidden-mobile" alt="Verzekeruzelf">
          <img class="img-responsive center" src="sites/all/themes/vuz/image/verzekering_premie.png" alt="premie">
        </picture>
      </div>
    </section>

    <section class="white">
      <div class="container">
        <?php if (!empty($page['contentBottomColumn1'])): ?>
          <div class="col-xs-12 col-sm-6"><?php print render($page['contentBottomColumn1']); ?></div>
        <?php endif; ?> 
        <?php if (!empty($page['contentBottomColumn2'])): ?>
          <div class="col-xs-12 col-sm-6"><?php print render($page['contentBottomColumn2']); ?></div>
        <?php endif; ?>        
        <div class="col-xs-12 col-sm-6 col-md-3"><?php print render($page['whiteContentWidget1']); ?></div>
        <div class="col-xs-12 col-sm-6 col-md-3"><?php print render($page['whiteContentWidget2']); ?></div>
        <div class="col-xs-12 col-sm-6 col-md-3"><?php print render($page['whiteContentWidget3']); ?></div>
        <div class="col-xs-12 col-sm-6 col-md-3"><?php print render($page['whiteContentWidget4']); ?></div>
      </div>
    </section>

    <?php include "./" . path_to_theme() . "/templates/page--footer.tpl.php"; ?>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

  </div>
</div>

<?php if (!empty($page['footer'])): ?>
  <footer class="footer">
    <div class="<?php print $container_class; ?>">
      <?php print render($page['footer']); ?>
    </div>
  </footer>
<?php endif; ?>


<?php
drupal_add_js('../sites/all/themes/vuz/js/modernizr.custom.min.js');
drupal_add_js('../sites/all/themes/vuz/js/jquery.colorbox.min.js');
drupal_add_js('../sites/all/themes/vuz/js/trigger.js');
drupal_add_js('../sites/all/themes/vuz/js/landing.resolver.js');

drupal_add_css($directory.'../sites/all/themes/vuz/css/colorbox.min.css', array('group' => CSS_THEME, 'every_page' => true));
?>
