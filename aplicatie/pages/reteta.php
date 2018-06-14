<div class="recipe">
  <h2> <?php echo $objReteta->titlu; ?> </h2>
  <img src="<?php echo $config['url'].$objReteta->imagine; ?>" alt="img">
  <h4>INGREDIENTE</h4>
  <?php foreach($db->query('SELECT * FROM ingrediente i LEFT JOIN retete_ingrediente ri ON ri.idingredient = i.idingredient WHERE ri.idreteta = '.$objReteta->idreteta.'') as $ingredient) { ?>
    &nbsp; &nbsp; &nbsp; <?php echo $ingredient->gramaj.' '.$ingredient->unitate.' '.$ingredient->numeingredient; ?><br />
  <?php } ?>
  <h4>MOD DE PREPARARE</h4>
  <?php foreach($db->query('SELECT * FROM pasi WHERE idreteta = '.$objReteta->idreteta.'') as $pas) { ?>
    <p><?php echo $pas->textpas; ?></p>
  <?php } ?>
</div>