<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST">

<input type="hidden" name="utilizator_id" value="<?php echo isset($utilizator->id) ? $utilizator->id : '0'; ?>" />

<?php if(isset($utilizator->id)) { ?>
<label for="utilizator_id">ID utilizator</label>
<input type="text" value="<?php echo $utilizator->id; ?>" disabled/>
<?php } ?>

<label for="utilizator_nume">Nume</label>
<input type="text" name="utilizator_nume" value="<?php echo isset($utilizator->id) ? $utilizator->nume : ''; ?>" required/>

<label for="utilizator_prenume">Prenume</label>
<input type="text" name="utilizator_prenume" value="<?php echo isset($utilizator->id) ? $utilizator->prenume : ''; ?>" required/>

<label for="utilizator_mail">E-Mail</label>
<input type="text" name="utilizator_mail" value="<?php echo isset($utilizator->id) ? $utilizator->email : ''; ?>" required/>

<label for="utilizator_parola">Parola</label>
<input type="password" placeholder="******" name="utilizator_parola" value="" <?php echo isset($utilizator->id) ? '' : 'required'; ?>/>

<label for="utilizator_data_nasterii">Data nasterii</label>
<input type="text" name="utilizator_data_nasterii" value="<?php echo isset($utilizator->id) ? $utilizator->datanasterii : ''; ?>" required/>

<label for="utilizator_rol">Rol</label>
<select name="utilizator_rol" id="utilizator_rol">
  <option value="user"<?php echo isset($utilizator->id) && $utilizator->rol == 'user' ? 'selected' : ''; ?>>Utilizator</option>
  <option value="admin"<?php echo isset($utilizator->id) && $utilizator->rol == 'admin' ? 'selected' : ''; ?>>Admin</option>
</select>
<br />
<input type="submit" name="save" value="Salveaza">



</form>