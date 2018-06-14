<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST">

<input type="hidden" name="instrument_id" value="<?php echo isset($instrument->idinstrument) ? $instrument->idinstrument : '0'; ?>" />

<?php if(isset($instrument->idinstrument)) { ?>
<label for="instrument_id">ID instrument</label>
<input type="text" value="<?php echo $instrument->idinstrument; ?>" disabled/>
<?php } ?>

<label for="instrument_nume">Nume instrument</label>
<input type="text" name="instrument_nume" value="<?php echo isset($instrument->idinstrument) ? $instrument->numeinstrument : ''; ?>" required/>
<br />
<input type="submit" name="save" value="Salveaza">



</form>