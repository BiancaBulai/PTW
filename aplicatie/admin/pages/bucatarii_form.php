<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST" enctype="multipart/form-data">

<input type="hidden" name="bucatarie_id" value="<?php echo isset($bucatarie->idbucatarie) ? $bucatarie->idbucatarie : '0'; ?>" />

<?php if(isset($bucatarie->idbucatarie)) { ?>
<label for="bucatarie_id">ID bucatarie</label>
<input type="text" value="<?php echo $bucatarie->idbucatarie; ?>" disabled/>
<?php } ?>

<label for="bucatarie_nume">Nume bucatarie</label>
<input type="text" name="bucatarie_nume" value="<?php echo isset($bucatarie->idbucatarie) ? $bucatarie->numebucatarie : ''; ?>" required/>

<label for="bucatarie_imagine">Imagine bucatarie<?php if(isset($bucatarie->imagine)) { ?> <small><i>( <a href="<?php echo $config['url'].$bucatarie->imagine; ?>" target="_blank">current image</a> )</i></small><?php } ?></label>
<input type="file" name="bucatarie_imagine" accept="image/*" value=""/>
<br />
<input type="submit" name="save" value="Salveaza">



</form>