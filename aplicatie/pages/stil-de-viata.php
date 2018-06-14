<?php
// Setari pagina
$currentMenu  = 'stil-de-viata';
$pageTitle    = 'Stil de viata';

// Header
require 'layout/header.php';

// Detalii stil
if(!empty($routeData[1])) {
  $objStil = $db->query('SELECT * FROM stil WHERE url = "'.$routeData[1].'"')->fetch();
  if(!isset($objStil->idstil)) { exit('404'); }
  $pageTitle .= ' - '.$objStil->numestil;
}

// Detalii reteta
if(!empty($routeData[2])) {
  $objReteta = $db->query('SELECT r.*, i.cale FROM retete r LEFT JOIN imagini i ON i.idreteta = r.idreteta WHERE url = "'.$routeData[2].'"')->fetch();
  if(!isset($objReteta->idreteta)) { exit('404'); }
  $pageTitle .= ' - '.$objReteta->titlu;
}

?>

<?php if(empty($routeData[1])) { ?>

<ul class="recipe-list">
    <?php foreach($db->query('SELECT * FROM stil') as $stil) { ?>
    <li class="recipe-item">
        <img src="<?php echo $stil->imagine; ?>" alt="">
        <div>
            <h2><?php echo $stil->numestil; ?></h2>
            <ol>
              <?php foreach($db->query('SELECT * FROM retete WHERE stilid = '.$stil->idstil) as $reteta) { ?>
                <li><a href="<?php echo $config['url'];?><?php echo $currentMenu; ?>/<?php echo $stil->url; ?>/<?php echo $reteta->url; ?>"><?php echo $reteta->titlu; ?></a></li>
              <?php } ?>
            </ol>
        </div>
    </li>
  <?php } ?>
</ul>
<?php }elseif(!empty($routeData[1]) && empty($routeData[2])) { ?>

  // TODO

<?php }elseif(!empty($routeData[1]) && !empty($routeData[2])) { 
  require 'reteta.php';
} ?>

<?php
// Header
require 'layout/footer.php';
?>