<?php
// Setari pagina
$currentMenu  = 'retete';
$pageTitle    = 'Retete';

// Header
require 'layout/header.php';


// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['reteta_id']) && $_POST['reteta_id'] > 0) { 
        
        // Salvare reteta
        $db->prepare("UPDATE retete SET titlu = ?, url = ?, masaid = ?, bucatarieid = ?, preparareid = ?, regimid = ?, stilid = ?  WHERE idreteta = ?")->execute(array($_POST['reteta_titlu'], slugify($_POST['reteta_titlu']), (int)$_POST['reteta_masa'], (int)$_POST['reteta_bucatarie'], (int)$_POST['reteta_preparare'], (int)$_POST['reteta_regim'], (int)$_POST['reteta_stil'], $_POST['reteta_id']));

        // Salvare pasi
        $idPasi = array(0);
        if(isset($_POST['reteta_pasi_id'])) {
            foreach($_POST['reteta_pasi_id'] as $key => $pas) {
                if($pas > 0) {
                    $idPasi[] = $pas;
                    $db->prepare("UPDATE pasi SET textpas = ?, timp = ? WHERE idpas = ? AND idreteta = ?")->execute(array($_POST['reteta_pasi'][$key], (int)$_POST['reteta_pasi_timp'][$key], $pas, $_POST['reteta_id']));
                }else{
                    $db->prepare("INSERT INTO pasi (textpas, timp, idreteta) VALUES (?, ?, ?)")->execute(array($_POST['reteta_pasi'][$key], (int)$_POST['reteta_pasi_timp'][$key], $_POST['reteta_id']));
                    $idPasi[] = $db->lastInsertId();
                }
            }
        }

        // Salvare id reteta pentru legaturi daca este nevoie
        $idReteta = $_POST['reteta_id'];


        // Stergere pasi vechi
        $query = $db->prepare("DELETE FROM pasi WHERE idpas NOT IN (".implode(',', $idPasi).") AND idreteta = ?")->execute(array($_POST['reteta_id']));

    }else{ 

        $db->prepare("INSERT INTO retete (titlu, url, masaid, bucatarieid, preparareid, regimid, stilid) VALUES (?, ?, ?, ?, ?, ?, ?)")->execute(array($_POST['reteta_titlu'], slugify($_POST['reteta_titlu']), (int)$_POST['reteta_masa'], (int)$_POST['reteta_bucatarie'], (int)$_POST['reteta_preparare'], (int)$_POST['reteta_regim'], (int)$_POST['reteta_stil']));
        $idReteta = $db->lastInsertId();

        if(isset($_POST['reteta_pasi_id']) && $idReteta > 0) {
            foreach($_POST['reteta_pasi_id'] as $key => $pas) {
                $db->prepare("INSERT INTO pasi (textpas, timp, idreteta) VALUES (?, ?, ?)")->execute(array($_POST['reteta_pasi'][$key], (int)$_POST['reteta_pasi_timp'][$key], $idReteta));
            }
        }

    }


    // Salvare ingrediente
    $idIngrediente = array(0);
    if(isset($_POST['reteta_ingredient_id'])) {
        foreach($_POST['reteta_ingredient_id'] as $key => $id) {
            if($id > 0) {
                $idIngrediente[] = $id;
                $db->prepare("UPDATE retete_ingrediente SET gramaj = ?, unitate = ? WHERE id = ?")->execute(array($_POST['reteta_ingredient_gramaj'][$key], $_POST['reteta_ingredient_unitate'][$key], $id));
            }else{
                $db->prepare("INSERT INTO retete_ingrediente (gramaj, unitate, idingredient, idreteta) VALUES (?, ?, ?, ?)")->execute(array($_POST['reteta_ingredient_gramaj'][$key], $_POST['reteta_ingredient_unitate'][$key], $_POST['reteta_ingredient'][$key], $idReteta));
                $idIngrediente[] = $db->lastInsertId();
            }
        }
    }

    // Stergere ingrediente vechi
    $query = $db->prepare("DELETE FROM retete_ingrediente WHERE id NOT IN (".implode(',', $idIngrediente).") AND idreteta = ?")->execute(array($idReteta));

    // Salvare instrumente
    $idInstrumente = array(0);
    if(isset($_POST['reteta_instrumente'])) {
        foreach($_POST['reteta_instrumente'] as $instrument) {
            if($instrument > 0) {
                $db->prepare("INSERT IGNORE INTO retete_instrumente (idreteta, idinstrument) VALUES (?, ?)")->execute(array($idReteta, $instrument));
                $idInstrumente[] = $instrument;
            }
        }
    }

    // Sterge instrumente
    $query = $db->prepare("DELETE FROM retete_instrumente WHERE idinstrument NOT IN (".implode(',', $idInstrumente).") AND idreteta = ?")->execute(array($idReteta));

    // Salvare boli
    $idBoli = array(0);
    if(isset($_POST['reteta_boli'])) {
        foreach($_POST['reteta_boli'] as $boala) {
            if($boala > 0) {
                $db->prepare("INSERT IGNORE INTO retete_boli (idreteta, idboala) VALUES (?, ?)")->execute(array($idReteta, $boala));
                $idBoli[] = $boala;
            }
        }
    }

    // Sterge boli
    $query = $db->prepare("DELETE FROM retete_boli WHERE idboala NOT IN (".implode(',', $idBoli).") AND idreteta = ?")->execute(array($idReteta));


    // Salvare alergii
    $idAlergii = array(0);
    if(isset($_POST['reteta_alergii'])) {
        foreach($_POST['reteta_alergii'] as $alergie) {
            if($alergie > 0) {
                $db->prepare("INSERT IGNORE INTO retete_alergii (idreteta, idalergie) VALUES (?, ?)")->execute(array($idReteta, $alergie));
                $idAlergii[] = $alergie;
            }
        }
    }

    // Sterge alergii
    $query = $db->prepare("DELETE FROM retete_alergii WHERE idalergie NOT IN (".implode(',', $idAlergii).") AND idreteta = ?")->execute(array($idReteta));


    
    // Salvare imagine
    if(isset($_FILES['reteta_imagine']) && $_FILES['reteta_imagine']['tmp_name'] != '') {
        if(in_array(mime_content_type($_FILES['reteta_imagine']['tmp_name']), array('image/png', 'image/jpeg', 'image/jpg'))) {
            $fileInfo = pathinfo($_FILES['reteta_imagine']['name']);
            $newFileName = md5(rand(1000000, 9999999).time()).'.'.$fileInfo['extension'];
            move_uploaded_file($_FILES['reteta_imagine']['tmp_name'], __DIR__.'/../../files/'.$newFileName); 
            $db->prepare("UPDATE retete SET imagine = ? WHERE idreteta = ?")->execute(array('files/'.$newFileName, $idReteta));

        }
    }


    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');
    die;
}


?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'retete_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $reteta = $db->prepare('SELECT * FROM retete WHERE idreteta = ?');
    $reteta->execute(array($routeData[2]));
    $reteta = $reteta->fetch();
    require 'retete_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM retete WHERE idreteta = ?')->execute(array($routeData[2]));
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?sters');
}else{ ?>
    <?php if(isset($_GET['salvat'])) { ?><p class="text-verde"><i>(!) Datele au fost salvate cu succes.</i></p> <?php } ?>
    <?php if(isset($_GET['sters'])) { ?><p class="text-rosu"><i>(!) Datele au fost sterse cu succes.</i></p> <?php } ?>
    <table width="100%">
        <thead>
            <tr class="table-header">
                <td width="5%">ID</td>
                <td>Titlu</td>
                <td>Bucatarie</td>
                <td>Regim</td>
                <td>Stil</td>
                <td width="10%"><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/adauga'; ?>">Adauga</a></td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($db->query('SELECT * FROM retete r LEFT JOIN bucatarii b ON b.idbucatarie = r.bucatarieid LEFT JOIN stil s ON s.idstil = r.stilid LEFT JOIN regim re ON re.idregim = r.regimid ORDER BY idreteta DESC') as $reteta) { 
            ?>
            <tr>
                <td><?php echo $reteta->idreteta; ?></td>
                <td><?php echo $reteta->titlu; ?></td>
                <td><?php echo $reteta->numebucatarie; ?></td>
                <td><?php echo $reteta->numeregim; ?></td>
                <td><?php echo $reteta->numestil; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$reteta->idreteta; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$reteta->idreteta; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
<br /><br />
<?php
// Header
require 'layout/footer.php';
?>