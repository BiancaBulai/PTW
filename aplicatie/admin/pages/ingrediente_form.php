<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST">

<input type="hidden" name="ingredient_id" value="<?php echo isset($ingredient->idingredient) ? $ingredient->idingredient : '0'; ?>" />

<?php if(isset($ingredient->idingredient)) { ?>
<label for="ingredient_id">ID ingredient</label>
<input type="text" value="<?php echo $ingredient->idingredient; ?>" disabled/>
<?php } ?>

<label for="ingredient_nume">Nume ingredient</label>
<input type="text" name="ingredient_nume" value="<?php echo isset($ingredient->idingredient) ? $ingredient->numeingredient : ''; ?>" required/>
<br />
<input type="submit" name="save" value="Salveaza">



</form>