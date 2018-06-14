<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST">

<input type="hidden" name="boala_id" value="<?php echo isset($boala->idboala) ? $boala->idboala : '0'; ?>" />

<?php if(isset($boala->idboala)) { ?>
<label for="boala_id">ID boala</label>
<input type="text" value="<?php echo $boala->idboala; ?>" disabled/>
<?php } ?>

<label for="boala_nume">Nume boala</label>
<input type="text" name="boala_nume" value="<?php echo isset($boala->idboala) ? $boala->numeboala : ''; ?>" required/>
<br />
<input type="submit" name="save" value="Salveaza">



</form>