<?php
// Setari pagina
$currentMenu  = 'profil';
$pageTitle    = 'Profil';

// Header
require 'layout/header.php';

// Verificam daca este logat
if(!isset($_SESSION['user_id'])) {
    header('Location: '.$config['url'.'login']);
}

// Salveaza profil
if(isset($_POST['salveaza-profil'])) {

    // Verifica daca mail-ul exista deja
    $checkMail = $db->prepare('SELECT * FROM utilizatori WHERE email = ? AND id <> ?');
    $checkMail->execute(array($_POST['email'], $_SESSION['user_id']));
    $checkMail = $checkMail->fetch();
    
    if(isset($checkMail->id)) {
        header('Location: '.$config['url'].'profil?mail-exista-deja');
        exit;
    }
    // Salveaza datele personale
    $db->prepare("UPDATE utilizatori SET nume = ?, prenume = ?, datanasterii = ?, email = ? WHERE id = ?")
        ->execute(
            array(
                $_POST['nume'], 
                $_POST['prenume'], 
                date('Y-m-d', strtotime($_POST['datanasterii'])),
                $_POST['email'],
                $_SESSION['user_id']
            )
        );

    header('Location: '.$config['url'].'profil?profil-salvat');

}

// Salveaza datele
if(isset($_POST['salveaza-date'])) {

    // Salveaza boli
    $idBoli = array(0);
    if(isset($_POST['lista_boli'])) {
        foreach($_POST['lista_boli'] as $boala) {
            if($boala > 0) {
                $db->prepare("INSERT IGNORE INTO utilizatori_boli (idutilizator, idboala) VALUES (?, ?)")
                    ->execute(
                        array(
                            $_SESSION['user_id'], $boala
                        )
                    );
                $idBoli[] = $boala;
            }
        }
    }

    // Sterge boli
    $query = $db->prepare("DELETE FROM utilizatori_boli WHERE idboala NOT IN (".implode(',', $idBoli).") AND idutilizator = ?")
        ->execute(
            array(
                $_SESSION['user_id']
            )
        );


    // Salveaza alergii
    $idAlergii = array(0);
    if(isset($_POST['lista_alergii'])) {
        foreach($_POST['lista_alergii'] as $alergie) {
            if($alergie > 0) {
                $db->prepare("INSERT IGNORE INTO utilizatori_alergii (idutilizator, idalergie) VALUES (?, ?)")
                    ->execute(
                        array(
                            $_SESSION['user_id'], 
                            $alergie
                        )
                    );
                $idAlergii[] = $alergie;
            }
        }
    }

    // Sterge alergii
    $query = $db->prepare("DELETE FROM utilizatori_alergii WHERE idalergie NOT IN (".implode(',', $idAlergii).") AND idutilizator = ?")
        ->execute(
            array(
                $_SESSION['user_id']
            )
        );

    header('Location: '.$config['url'].'profil?date-salvate');

}

// Detalii utilizator ( folosite pentru a completa campurile )
$dateProfil = $db->prepare('SELECT * FROM utilizatori WHERE id = ?');
$dateProfil->execute(array($_SESSION['user_id']));
$dateProfil = $dateProfil->fetch();

?>

<div class="box b">
    <div class="container">
        <div class="row">
            <div class="column half">
                <div class="row">
                    <div class="column full">
                        <form action="<?php echo $config['url'].'profil'; ?>" method="POST" name="profilForm">
                            <h2>Date personale</h2>
                            <?php if(isset($_GET['profil-salvat'])) { ?><span class="text-verde">Profilul a fost actualizat</span><?php } ?>
                            <label for="nume">Nume</label>
                            <input type="text" name="nume" value="<?php echo isset($dateProfil->nume) ? $dateProfil->nume : ''; ?>" placeholder="Ion" required/>
                            <label for="prenume">Prenume</label>
                            <input type="text" name="prenume" value="<?php echo isset($dateProfil->prenume) ? $dateProfil->prenume : ''; ?>" placeholder="Ionescu" required/>
                            <label for="datanasterii">Data nasterii</label>
                            <input type="date" name="datanasterii" value="<?php echo isset($dateProfil->datanasterii) ? $dateProfil->datanasterii : ''; ?>" required/>
                            <label for="email">
                                Adresa mail
                                <?php if(isset($_GET['mail-exista-deja'])) { ?><small style="float: right;" class="text-rosu">Mail-ul exista deja</small> <?php } ?>
                            </label>
                            <input type="mail" name="email" value="<?php echo isset($dateProfil->email) ? $dateProfil->email : ''; ?>" required/>
                            <br />
                            <input type="submit" name="salveaza-profil" value="Actualizeaza profil"/>
                        </form>
                    </div>
                </div>
            </div>
            <div class="column half">
                <form action="<?php echo $config['url'].'profil'; ?>" method="POST" name="profilForm">
                    <h2>Detalii personale</h2>
                    <?php if(isset($_GET['date-salvate'])) { ?><span class="text-verde">Datele au fost salvate</span><?php } ?>
                    <label for="lista_boli">Boli</label>
                    <select name="lista_boli[]" id="lista_boli" style="height: 90px;" multiple>
                        <option value="">-- Selecteaza boala --</option>
                        <?php foreach($db->query('SELECT b.*, ub.idutilizator FROM boli b LEFT JOIN utilizatori_boli ub ON (ub.idboala = b.idboala AND ub.idutilizator = '.$_SESSION['user_id'].') ORDER BY b.idboala DESC') as $boala) { ?>
                        <option value="<?php echo $boala->idboala; ?>" <?php echo isset($boala->idutilizator) && $boala->idutilizator > 0 ? 'selected' : ''; ?>><?php echo $boala->numeboala; ?></option>
                        <?php } ?>
                    </select>
                    <label for="lista_alergii">Alergii</label>
                    <select name="lista_alergii[]" id="lista_alergii" style="height: 90px;" multiple>
                        <option value="">-- Selecteaza alergie --</option>
                        <?php foreach($db->query('SELECT a.*, ua.idutilizator FROM alergii a LEFT JOIN utilizatori_alergii ua ON (ua.idalergie = a.idalergie AND ua.idutilizator = '.$_SESSION['user_id'].') ORDER BY a.idalergie DESC') as $alergie) { ?>
                        <option value="<?php echo $alergie->idalergie; ?>" <?php echo isset($alergie->idutilizator) && $alergie->idutilizator > 0 ? 'selected' : ''; ?>><?php echo $alergie->numealergie; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                    <input type="submit" name="salveaza-date" value="Salveaza date"/>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

// Header
require 'layout/footer.php';

?>