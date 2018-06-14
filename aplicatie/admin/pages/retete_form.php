<form action="<?php $config['url'].'admin/'.$currentMenu; ?>" method="POST" enctype="multipart/form-data">

<input type="hidden" name="reteta_id" value="<?php echo isset($reteta->idreteta) ? $reteta->idreteta : '0'; ?>" />

<?php if(isset($reteta->idreteta)) { ?>
<label for="reteta_id">ID reteta</label>
<input type="text" value="<?php echo $reteta->idreteta; ?>" disabled/>
<?php } ?>

<label for="reteta_titlu">Titlu</label>
<input type="text" name="reteta_titlu" value="<?php echo isset($reteta->idreteta) ? $reteta->titlu : ''; ?>" required/>

<label for="reteta_imagine">Imagine<?php if(isset($reteta->imagine)) { ?> <small><i>( <a href="<?php echo $config['url'].$reteta->imagine; ?>" target="_blank">current image</a> )</i></small><?php } ?></label>
<input type="file" name="reteta_imagine" accept="image/*" value=""/>

<label for="reteta_masa">Masa</label>
<select name="reteta_masa" id="reteta_masa" required>
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT * FROM mese ORDER BY idmasa DESC') as $masa) { ?>
  <option value="<?php echo $masa->idmasa; ?>" <?php echo isset($reteta->idreteta) && $reteta->masaid == $masa->idmasa ? 'selected' : ''; ?>><?php echo $masa->numemasa; ?></option>
  <?php } ?>
</select>

<label for="reteta_bucatarie">Bucatarie</label>
<select name="reteta_bucatarie" id="reteta_bucatarie">
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT * FROM bucatarii ORDER BY idbucatarie DESC') as $bucatarie) { ?>
  <option value="<?php echo $bucatarie->idbucatarie; ?>" <?php echo isset($reteta->idreteta) && $reteta->bucatarieid == $bucatarie->idbucatarie ? 'selected' : ''; ?>><?php echo $bucatarie->numebucatarie; ?></option>
  <?php } ?>
</select>

<label for="reteta_regim">Regim</label>
<select name="reteta_regim" id="reteta_regim">
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT * FROM regim ORDER BY idregim DESC') as $regim) { ?>
  <option value="<?php echo $regim->idregim; ?>" <?php echo isset($reteta->idreteta) && $reteta->regimid == $regim->idregim ? 'selected' : ''; ?>><?php echo $regim->numeregim; ?></option>
  <?php } ?>
</select>

<label for="reteta_stil">Stil</label>
<select name="reteta_stil" id="reteta_stil">
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT * FROM stil ORDER BY idstil DESC') as $stil) { ?>
  <option value="<?php echo $stil->idstil; ?>" <?php echo isset($reteta->idreteta) && $reteta->stilid == $stil->idstil ? 'selected' : ''; ?>><?php echo $stil->numestil; ?></option>
  <?php } ?>
</select>

<label for="reteta_preparare">Preparare</label>
<select name="reteta_preparare" id="reteta_preparare" required>
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT * FROM preparare ORDER BY idpreparare DESC') as $preparare) { ?>
  <option value="<?php echo $preparare->idpreparare; ?>" <?php echo isset($reteta->idreteta) && $reteta->preparareid == $preparare->idpreparare ? 'selected' : ''; ?>><?php echo $preparare->metodapreparare; ?></option>
  <?php } ?>
</select>

<label for="reteta_instrumente">Instrumente folosite</label>
<select name="reteta_instrumente[]" id="reteta_instrumente" multiple style="height: 100px">
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT i.*, ri.idreteta FROM instrumente i LEFT JOIN retete_instrumente ri ON (ri.idinstrument = i.idinstrument AND ri.idreteta = '.(int)@$reteta->idreteta.') ORDER BY idinstrument DESC') as $instrument) { ?>
  <option value="<?php echo $instrument->idinstrument; ?>" <?php echo isset($instrument->idreteta) && $instrument->idreteta > 0 ? 'selected' : ''; ?>><?php echo $instrument->numeinstrument; ?></option>
  <?php } ?>
</select>

<label for="reteta_boli">Boli asociate</label>
<select name="reteta_boli[]" id="reteta_boli" multiple style="height: 100px">
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT b.*, rb.idreteta FROM boli b LEFT JOIN retete_boli rb ON (rb.idboala = b.idboala AND rb.idreteta = '.(int)@$reteta->idreteta.') ORDER BY idboala DESC') as $boala) { ?>
  <option value="<?php echo $boala->idboala; ?>" <?php echo isset($boala->idreteta) && $boala->idreteta > 0 ? 'selected' : ''; ?>><?php echo $boala->numeboala; ?></option>
  <?php } ?>
</select>

<label for="reteta_alergii">Alergii asociate</label>
<select name="reteta_alergii[]" id="reteta_alergii" multiple style="height: 100px">
  <option value="">-- Selecteaza --</option>
  <?php foreach($db->query('SELECT a.*, ra.idreteta FROM alergii a LEFT JOIN retete_alergii ra ON (ra.idalergie = a.idalergie AND ra.idreteta = '.(int)@$reteta->idreteta.') ORDER BY idalergie DESC') as $alergie) { ?>
  <option value="<?php echo $alergie->idalergie; ?>" <?php echo isset($alergie->idreteta) && $alergie->idreteta > 0 ? 'selected' : ''; ?>><?php echo $alergie->numealergie; ?></option>
  <?php } ?>
</select>
<br />
<label for="reteta_ingrediente">Ingrediente 
  <select style="float:right; cursor: pointer; width: 200px; display: inline-block; padding: 3px; font-size: 10px; height: 30px;" onchange="adaugaIngredient(event)" id="ingredientSelector">
    <option value="">-- Adauga ingredient --</option>
  <?php foreach($db->query('SELECT * FROM ingrediente ORDER BY idingredient DESC') as $ingredient) { ?>
    <option value="<?php echo $ingredient->idingredient; ?>"><?php echo $ingredient->numeingredient; ?></option>
  <?php } ?>
  </select>
</label>
<br />
<div id="container_ingrediente">
  <?php if(isset($reteta->idreteta)) { ?>
    <?php foreach($db->query('SELECT * FROM retete_ingrediente ri LEFT JOIN ingrediente i ON i.idingredient = ri.idingredient WHERE ri.idreteta = '.@$reteta->idreteta.' ORDER BY ri.idingredient ASC') as $ingredient) { ?>
      <div class="row">
        <div class="column half" style="width: 20%">
          Gramaj
          <input type="hidden" name="reteta_ingredient_id[<?php echo $ingredient->id; ?>]" value="<?php echo $ingredient->id; ?>" />
          <input type="text" name="reteta_ingredient_gramaj[<?php echo $ingredient->id; ?>]" value="<?php echo $ingredient->gramaj; ?>" />
        </div>
        <div class="column half" style="width: 20%">
          Unitate
          <input type="text" name="reteta_ingredient_unitate[<?php echo $ingredient->id; ?>]" value="<?php echo $ingredient->unitate; ?>" />
        </div>
        <div class="column half" style="width: 60%">
          Ingredient <span style="float:right; cursor: pointer" onclick="stergePas(event)">Sterge ingredient</span>
          <input type="hidden" name="reteta_ingredient[<?php echo $ingredient->id; ?>]" value="<?php echo $ingredient->idingredient; ?>" />
          <input name="reteta_ingredient[<?php echo $ingredient->id; ?>]" value="<?php echo $ingredient->numeingredient; ?>" disabled/>
        </div>
        <div style="clear: both;"><br /></div>
      </div>
    <?php } ?>
  <?php } ?>
</div>
<br />
<label for="reteta_pasi">Pasi <span style="float:right; cursor: pointer;" onclick="adaugaPas(event)">Adauga pas</span></label>
<div id="container_pasi">
  <?php if(isset($reteta->idreteta)) { ?>
    <?php foreach($db->query('SELECT * FROM pasi WHERE idreteta = '.$reteta->idreteta.' ORDER BY idpas ASC') as $pas) { ?>
      <div class="row">
        <div class="column half" style="width: 10%">
          Timp ( minute )
          <input type="hidden" name="reteta_pasi_id[<?php echo $pas->idpas; ?>]" value="<?php echo $pas->idpas; ?>" />
          <input type="number" min="0" step="1" name="reteta_pasi_timp[<?php echo $pas->idpas; ?>]" value="<?php echo $pas->timp; ?>" />
        </div>
        <div class="column half" style="width: 90%">
          Text <span style="float:right; cursor: pointer" onclick="stergePas(event)">Sterge pas</span>
          <input name="reteta_pasi[<?php echo $pas->idpas; ?>]" value="<?php echo $pas->textpas; ?>" />
        </div>
        <div style="clear: both;"><br /></div>
      </div>
      
    <?php } ?>
  <?php } ?>
</div>
<br />
<input type="submit" name="save" value="Salveaza">
</form>


<script type="text/javascript">
  function stergePas(e) {
    var element = e.target.parentNode.parentNode;
    element.parentNode.removeChild(element);
  }
  function adaugaPas() {
    var container_pasi = document.getElementById('container_pasi');
    container_pasi.insertAdjacentHTML('beforeend', '<div class="row"><div class="column half" style="width: 10%">Timp ( minute )<input type="hidden" name="reteta_pasi_id[]" value="0" /><input type="number" min="0" step="1" name="reteta_pasi_timp[]" value="" /></div><div class="column half" style="width: 90%">Text <span style="float:right; cursor: pointer" onclick="stergePas(event)">Sterge pas</span><input name="reteta_pasi[]" value="" /></div><div style="clear: both;"><br /></div></div>');
  }
  function adaugaIngredient(e) {
    var ingredientSelector = document.getElementById('ingredientSelector');
    console.log(ingredientSelector.options[ingredientSelector.selectedIndex].value);
    console.log(ingredientSelector.options[ingredientSelector.selectedIndex].text);
    var container_ingrediente = document.getElementById('container_ingrediente');
    container_ingrediente.insertAdjacentHTML('beforeend', '<div class="row"><div class="column half" style="width: 20%">Gramaj<input type="hidden" name="reteta_ingredient_id[]" value="" /><input type="text" name="reteta_ingredient_gramaj[]" value="1" required/></div><div class="column half" style="width: 20%">Unitate<input type="text" name="reteta_ingredient_unitate[]" value="buc" required /></div><div class="column half" style="width: 60%">Ingredient <span style="float:right; cursor: pointer" onclick="stergePas(event)">Sterge ingredient</span><input type="hidden" name="reteta_ingredient[]" value="'+ingredientSelector.options[ingredientSelector.selectedIndex].value+'" /><input type="text" name="reteta_ingredient_nume[]" value="'+ingredientSelector.options[ingredientSelector.selectedIndex].text+'" disabled/></div><div style="clear: both;"><br /></div></div>');
    ingredientSelector.selectedIndex = 0;
  }
</script>