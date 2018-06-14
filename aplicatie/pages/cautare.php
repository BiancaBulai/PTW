<?php
// Setari pagina
$currentMenu  = 'cautare';
$pageTitle    = 'Cautare';

// Header
require 'layout/header.php';

$query = 'SELECT r.*, b.url as urlbucatarie, reg.url as urlregim, s.url as stilurl
  FROM retete r 
  LEFT JOIN retete_boli rb ON rb.idreteta = r.idreteta
  LEFT JOIN retete_alergii ra ON ra.idreteta = r.idreteta
  LEFT JOIN retete_instrumente ri ON ri.idreteta = r.idreteta
  LEFT JOIN retete_ingrediente ring ON ring.idreteta = r.idreteta
  LEFT JOIN bucatarii b ON b.idbucatarie = r.bucatarieid
  LEFT JOIN regim reg ON reg.idregim = r.regimid
  LEFT JOIN stil s ON s.idstil = r.stilid'; 

$conditii = array();

$idBucatarii = array();
$idRegim = array();
$idStil = array();
$idBoli = array();
$idAlergii = array();
$idInstrumente = array();
$idPreparare = array();
$idMese = array();

if(isset($_POST['bucatarie'])) {
  foreach($_POST['bucatarie'] as $bucatarie) { if($bucatarie > 0) { $idBucatarii[] = $bucatarie; } }
  if(count($idBucatarii) > 0) { $conditii[] = 'bucatarieid IN ('.implode(',', $idBucatarii).')'; }
}

if(isset($_POST['regim'])) {
  foreach($_POST['regim'] as $regim) { if($regim > 0) { $idRegim[] = $regim; } }
  if(count($idRegim) > 0) { $conditii[] = 'regimid IN ('.implode(',', $idRegim).')'; }
}

if(isset($_POST['stil'])) {
  foreach($_POST['stil'] as $stil) { if($stil > 0) { $idStil[] = $stil; } }
  if(count($idStil) > 0) { $conditii[] = 'stilid IN ('.implode(',', $idStil).')'; }
}

if(isset($_POST['boala'])) {
  foreach($_POST['boala'] as $boala) { if($boala > 0) { $idBoli[] = $boala; } }
  if(count($idBoli) > 0) { $conditii[] = 'rb.idboala IN ('.implode(',', $idBoli).')'; }
}

if(isset($_POST['alergie'])) {
  foreach($_POST['alergie'] as $alergie) { if($alergie > 0) { $idAlergii[] = $alergie; } }
  if(count($idAlergii) > 0) { $conditii[] = 'ra.idalergie IN ('.implode(',', $idAlergii).')'; }
}

if(isset($_POST['instrument'])) {
  foreach($_POST['instrument'] as $instrument) { if($instrument > 0) { $idInstrumente[] = $instrument; } }
  if(count($idInstrumente) > 0) { $conditii[] = 'ri.idinstrument IN ('.implode(',', $idInstrumente).')'; }
}

if(isset($_POST['preparare'])) {
  foreach($_POST['preparare'] as $preparare) { if($preparare > 0) { $idPreparare[] = $preparare; } }
  if(count($idPreparare) > 0) { $conditii[] = 'r.preparareid IN ('.implode(',', $idPreparare).')'; }
}

if(isset($_POST['masa'])) {
  foreach($_POST['masa'] as $masa) { if($masa > 0) { $idMese[] = $masa; } }
  if(count($idMese) > 0) { $conditii[] = 'r.masaid IN ('.implode(',', $idMese).')'; }
}

if(count($conditii) > 0) {
  $query .= ' WHERE '.implode(' AND ', $conditii);
}

?>

<div style="display: grid; grid-template-columns: 250px 1fr; ">

  <div>
    <h2>Cautare</h2>
    <form action="<?php echo $config['url'].'cautare'; ?>" method="POST">
      <label for="bucatarie">Bucatarie</label>
      <select name="bucatarie[]" id="bucatarie" style="height: 80px;" multiple>
        <option value="0" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM bucatarii') as $bucatarie) { ?>
          <option value="<?php echo $bucatarie->idbucatarie; ?>" <?php echo in_array($bucatarie->idbucatarie, $idBucatarii) ? 'selected' : '';?>><?php echo $bucatarie->numebucatarie; ?></option>
        <?php } ?>
      </select>
      <label for="regim">Regim</label>
      <select name="regim[]" id="regim" style="height: 80px;" multiple>
        <option value="" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM regim') as $regim) { ?>
          <option value="<?php echo $regim->idregim; ?>" <?php echo in_array($regim->idregim, $idRegim) ? 'selected' : '';?>><?php echo $regim->numeregim; ?></option>
        <?php } ?>
      </select>
      <label for="stil">Stil</label>
      <select name="stil[]" id="stil" style="height: 80px;" multiple>
        <option value="" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM stil') as $stil) { ?>
          <option value="<?php echo $stil->idstil; ?>" <?php echo in_array($stil->idstil, $idStil) ? 'selected' : '';?>><?php echo $stil->numestil; ?></option>
        <?php } ?>
      </select>
      <label for="boala">Boala</label>
      <select name="boala[]" id="boala" style="height: 80px;" multiple>
        <option value="" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM boli') as $boala) { ?>
          <option value="<?php echo $boala->idboala; ?>" <?php echo in_array($boala->idboala, $idBoli) ? 'selected' : '';?>><?php echo $boala->numeboala; ?></option>
        <?php } ?>
      </select>
      <label for="alergie">Alergie</label>
      <select name="alergie[]" id="alergie" style="height: 80px;" multiple>
        <option value="" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM alergii') as $alergie) { ?>
          <option value="<?php echo $alergie->idalergie; ?>" <?php echo in_array($alergie->idalergie, $idAlergii) ? 'selected' : '';?>><?php echo $alergie->numealergie; ?></option>
        <?php } ?>
      </select>
      <label for="instrument">Instrumente</label>
      <select name="instrument[]" id="instrument" style="height: 80px;" multiple>
        <option value="" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM instrumente') as $instrument) { ?>
          <option value="<?php echo $instrument->idinstrument; ?>" <?php echo in_array($instrument->idinstrument, $idInstrumente) ? 'selected' : '';?>><?php echo $instrument->numeinstrument; ?></option>
        <?php } ?>
      </select>
      <label for="preparare">Mod preparare</label>
      <select name="preparare[]" id="preparare" style="height: 80px;" multiple>
        <option value="" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM preparare') as $preparare) { ?>
          <option value="<?php echo $preparare->idpreparare; ?>" <?php echo in_array($preparare->idpreparare, $idPreparare) ? 'selected' : '';?>><?php echo $preparare->metodapreparare; ?></option>
        <?php } ?>
      </select>
      <label for="masa">Mese</label>
      <select name="masa[]" id="masa" style="height: 80px;" multiple>
        <option value="" selected>-- Toate --</option>
        <?php foreach($db->query('SELECT * FROM mese') as $masa) { ?>
          <option value="<?php echo $masa->idmasa; ?>" <?php echo in_array($masa->idmasa, $idMese) ? 'selected' : '';?>><?php echo $masa->numemasa; ?></option>
        <?php } ?>
      </select>
      <br />
      <input type="submit" value="Aplica filtre" />
    </form>
    <br />
    <br />

  </div>
  <div style="padding-left: 10px;">
    <h2>Rezultate</h2>
    <?php

    foreach($db->query($query.' GROUP BY r.idreteta') as $reteta) { 
      if($reteta->bucatarieid > 0) { $cat = 'preferinte-alimentare/'.$reteta->urlbucatarie; }
      elseif($reteta->regimid > 0) { $cat = 'restrictii-alimentare/'.$reteta->urlregim; }
      else { $cat = 'stil-de-viata/'.$reteta->urlstil; }
      ?>
      <div>
        <h2><a href="<?php echo $config['url'].$cat.'/'.$reteta->url; ?>"><?php echo $reteta->titlu; ?></a></h2>
        <img src="<?php echo $config['url'].$reteta->imagine; ?>" style="max-width: 200px; padding: 10px 20px 0 0;" align="left">
        <?php foreach($db->query('SELECT * FROM pasi WHERE idreteta = '.$reteta->idreteta.'') as $pas) { ?>
          <?php echo $pas->textpas; ?><br />
        <?php } ?>
      </div>
      <div style="clear: both;"></div>
    <?php } ?>
  </div>

</div>

<?php
// Header
require 'layout/footer.php';
?>