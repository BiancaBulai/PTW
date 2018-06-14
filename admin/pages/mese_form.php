<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST">

<input type="hidden" name="masa_id" value="<?php echo isset($masa->idmasa) ? $masa->idmasa : '0'; ?>" />

<?php if(isset($masa->idmasa)) { ?>
<label for="masa_id">ID masa</label>
<input type="text" value="<?php echo $masa->idmasa; ?>" disabled/>
<?php } ?>

<label for="masa_nume">Nume masa</label>
<input type="text" name="masa_nume" value="<?php echo isset($masa->idmasa) ? $masa->numemasa : ''; ?>" required/>
<br />
<input type="submit" name="save" value="Salveaza">



</form>