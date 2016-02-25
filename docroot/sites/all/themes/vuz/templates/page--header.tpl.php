<header id="navbar" role="banner">
  <div class="<?php print $navbar_classes; ?> <?php print $container_class; ?>">
    <div class="container">
       <div class="navbar-header ">

        <?php if ($logo): ?>
          <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
        <?php endif; ?>

  <!--       <?php if (!empty($site_name)): ?>
          <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">Verzekeruzelf</a>
        <?php endif; ?> -->

        <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <?php endif; ?>
      </div>

      <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        <div class="container navbar-collapse collapse ">
          <nav role="navigation">
            <?php if (!empty($primary_nav)): ?>
              <?php print render($primary_nav); ?>
            <?php endif; ?>
            <?php if (!empty($secondary_nav)): ?>
              <?php print render($secondary_nav); ?>
            <?php endif; ?>
            <?php if (!empty($page['navigation'])): ?>
              <?php print render($page['navigation']); ?>
            <?php endif; ?>
            
            <button type="button" class="btn pink btn-default" data-toggle="collapse" data-target=".loginBar" role="button" style="float:right;margin:10px;">Inloggen</button>   
          </nav>    
        </div>
      <?php endif; ?>
      <iframe class="loginBar collapse "width="100%" height="341" frameborder="0" scrolling="no" src="https://div.verzekeruzelf.nl/DIVPublic/logonbox.aspx?instanceid=1"></iframe>               
    </div>
  </div>


  <div class="greenBackground">
    <picture class="logo">
      <source media="(max-width: 480px)" srcset="sites/all/themes/vuz/image/logo-verzekeruzelf-mobile.png">
      <source media="(max-width: 978x)" srcset="sites/all/themes/vuz/image/logo-verzekeruzelf-normal.png">
      <source media="(max-width: 979px)" srcset="sites/all/themes/vuz/image/logo-verzekeruzelf-wide.png">
      <img class="img-responsive" src="sites/all/themes/vuz/image/logo-verzekeruzelf-wide.png" alt="Logo Verzekeruzelf">
    </picture>
  </div>
</header>

