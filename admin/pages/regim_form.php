<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST" enctype="multipart/form-data">

<input type="hidden" name="regim_id" value="<?php echo isset($regim->idregim) ? $regim->idregim : '0'; ?>" />

<?php if(isset($regim->idregim)) { ?>
<label for="regim_id">ID regim</label>
<input type="text" value="<?php echo $regim->idregim; ?>" disabled/>
<?php } ?>

<label for="regim_nume">Nume regim</label>
<input type="text" name="regim_nume" value="<?php echo isset($regim->idregim) ? $regim->numeregim : ''; ?>" required/>

<label for="regim_imagine">Imagine regim<?php if(isset($regim->imagine)) { ?> <small><i>( <a href="<?php echo $config['url'].$regim->imagine; ?>" target="_blank">current image</a> )</i></small><?php } ?></label>
<input type="file" name="regim_imagine" accept="image/*" value=""/>

<br />
<input type="submit" name="save" value="Salveaza">



</form>