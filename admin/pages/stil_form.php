<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST" enctype="multipart/form-data">

<input type="hidden" name="stil_id" value="<?php echo isset($stil->idstil) ? $stil->idstil : '0'; ?>" />

<?php if(isset($stil->idstil)) { ?>
<label for="stil_id">ID stil</label>
<input type="text" value="<?php echo $stil->idstil; ?>" disabled/>
<?php } ?>

<label for="stil_nume">Nume stil</label>
<input type="text" name="stil_nume" value="<?php echo isset($stil->idstil) ? $stil->numestil : ''; ?>" required/>

<label for="stil_imagine">Imagine stil<?php if(isset($stil->imagine)) { ?> <small><i>( <a href="<?php echo $config['url'].$stil->imagine; ?>" target="_blank">current image</a> )</i></small><?php } ?></label>
<input type="file" name="stil_imagine" accept="image/*" value=""/>

<br />
<input type="submit" name="save" value="Salveaza">



</form>