<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST">

  <input type="hidden" name="preparare_id value="<?php echo isset($preparare->idpreparare) ? $preparare->idpreparare : '0'; ?>" />

  <?php if(isset($preparare->idpreparare)) { ?>
  <label for="preparare_id">ID preparare</label>
  <input type="text" value="<?php echo $preparare->idpreparare; ?>" disabled/>
  <?php } ?>

  <label for="preparare_nume">Metoda de preparare</label>
  <input type="text" name="preparare_nume" value="<?php echo isset($preparare->idpreparare) ? $preparare->metodapreparare : ''; ?>" required/>
  <br />
  <input type="submit" name="save" value="Salveaza">

</form>