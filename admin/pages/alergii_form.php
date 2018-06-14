<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST">

  <input type="hidden" name="alergie_id" value="<?php echo isset($alergie->idalergie) ? $alergie->idalergie : '0'; ?>" />

  <?php if(isset($alergie->idalergie)) { ?>
  <label for="alergie_id">ID alergie</label>
  <input type="text" value="<?php echo $alergie->idalergie; ?>" disabled/>
  <?php } ?>

  <label for="alergie_nume">Nume alergie</label>
  <input type="text" name="alergie_nume" value="<?php echo isset($alergie->idalergie) ? $alergie->numealergie : ''; ?>" required/>
  <br />
  <input type="submit" name="save" value="Salveaza">

</form>