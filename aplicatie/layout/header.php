<?php
$menu = array(
  array('name' => 'acasa',                  'link' => '',                       'text' => 'Acasa'),
  array('name' => 'preferinte-alimentare',  'link' => 'preferinte-alimentare',  'text' => 'Preferinte alimentare'),
  array('name' => 'restrictii-alimentare',  'link' => 'restrictii-alimentare',  'text' => 'Restrictii alimentare'),
  array('name' => 'stil-de-viata',          'link' => 'stil-de-viata',          'text' => 'Stil de viata'),
  array('name' => 'cautare',                'link' => 'cautare',                'text' => 'Cautare'),
  array('name' => 'login',                  'link' => 'login',                  'text' => 'Login')
); 

if(isset($_SESSION['user_id'])) {
  unset($menu[5]);

  $menu[] = array('name' => 'profil', 'link' => 'profil', 'text' => 'Profil');
  $menu[] = array('name' => 'logout', 'link' => 'logout', 'text' => 'Logout');


  if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
    $menu[] = array('name' => 'admin', 'link' => 'admin', 'text' => 'Admin');
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, max-scale=1, min-scale=1 ">
    <title>Food &amp; Recipes<?= ($pageTitle != '' ? ' - '.$pageTitle : ''); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $config['url']; ?>assets/style.css">
  </head>
  <body>
    <div class="wrapper">
      <header>
          <a href="<?php echo $config['url']; ?>" id="logo"></a>
          <nav>
              <a href="" id="menu-icon"></a>
              <ul>
                <?php foreach($menu as $menuItem) { ?>
                <li><a href="<?php echo $config['url'].$menuItem['link']; ?>" <?php if(isset($currentMenu) && $currentMenu == $menuItem['name']) { echo 'class="current"'; }; ?>><?php echo $menuItem['text']; ?></a></li>
                <?php } ?>
              </ul>
          </nav>
      </header>
      <wrapper>