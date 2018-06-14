<?php
// Setari pagina
$currentMenu  = 'restrictii-alimentare';
$pageTitle    = 'Restrictii alimentare';

// Detalii regim
if(!empty($routeData[1])) {
  $objRegim = $db->query('SELECT * FROM regim WHERE url = "'.$routeData[1].'"')->fetch();
  if(!isset($objRegim->idregim)) { exit('404'); }
  $pageTitle .= ' - '.$objRegim->numeregim;
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
    <?php foreach($db->query('SELECT * FROM regim') as $regim) { ?>
    <li class="recipe-item">
        <img src="<?php echo $regim->imagine; ?>" alt="">
        <div>
            <h2><?php echo $regim->numeregim; ?></h2>
            <ol>
              <?php foreach($db->query('SELECT * FROM retete WHERE regimid = '.$regim->idregim) as $reteta) { ?>
                <li><a href="<?php echo $config['url'];?><?php echo $currentMenu; ?>/<?php echo $regim->url; ?>/<?php echo $reteta->url; ?>"><?php echo $reteta->titlu; ?></a></li>
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