<?php
$menu = array(
  array('name' => 'retete',       'link' => 'retete',     'text' => 'Retete'),
  array('name' => 'alergii',      'link' => 'alergii',    'text' => 'Alergii'),
  array('name' => 'boli',         'link' => 'boli',       'text' => 'Boli'),
  array('name' => 'bucatarii',    'link' => 'bucatarii',  'text' => 'Bucatarii'),
  array('name' => 'instrumente',  'link' => 'instrumente','text' => 'Instrumente'),
  array('name' => 'ingrediente',  'link' => 'ingrediente','text' => 'Ingrediente'),
  array('name' => 'mese',         'link' => 'mese',       'text' => 'Mese'),
  array('name' => 'regim',        'link' => 'regim',      'text' => 'Regim'),
  array('name' => 'stil',         'link' => 'stil',       'text' => 'Stil'),
  array('name' => 'utilizatori',  'link' => 'utilizatori','text' => 'Utilizatori'),
  array('name' => 'logout',       'link' => 'logout',     'text' => 'Logout'),
); 
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
                <li><a href="<?php echo $config['url'].'admin/'.$menuItem['link']; ?>" <?php if(isset($currentMenu) && $currentMenu == $menuItem['name']) { echo 'class="current"'; }; ?>><?php echo $menuItem['text']; ?></a></li>
                <?php } ?>
              </ul>
          </nav>
      </header>
      <wrapper>