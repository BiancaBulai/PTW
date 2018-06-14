<?php
// Setari pagina
$currentMenu  = 'preferinte-alimentare';
$pageTitle    = 'Preferinte alimentare';

// Detalii bucatarie
if(!empty($routeData[1])) {
  $objBucatarie = $db->query('SELECT * FROM bucatarii WHERE url = "'.$routeData[1].'"')->fetch();
  if(!isset($objBucatarie->idbucatarie)) { exit('404'); }
  $pageTitle .= ' - '.$objBucatarie->numebucatarie;
}

// Detalii reteta
if(!empty($routeData[2])) {
  $objReteta = $db->query('SELECT r.* FROM retete r WHERE url = "'.$routeData[2].'"')->fetch();
  if(!isset($objReteta->idreteta)) { exit('404'); }
  $pageTitle .= ' - '.$objReteta->titlu;
}

require 'layout/header.php';
?>

<?php if(empty($routeData[1])) { ?>

<ul class="recipe-list">
    <?php foreach($db->query('SELECT * FROM bucatarii') as $bucatarie) { ?>
    <li class="recipe-item">
        <img src="<?php echo $bucatarie->imagine; ?>" alt="">
        <div>
            <h2><?php echo $bucatarie->numebucatarie; ?></h2>
            <ol>
              <?php foreach($db->query('SELECT * FROM retete WHERE bucatarieid = '.$bucatarie->idbucatarie) as $reteta) { ?>
                <li><a href="<?php echo $config['url'];?><?php echo $currentMenu; ?>/<?php echo $bucatarie->url; ?>/<?php echo $reteta->url; ?>"><?php echo $reteta->titlu; ?></a></li>
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

<?php require 'layout/footer.php'; ?>