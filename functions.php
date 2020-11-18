<?php
include("infos_bd.php");

function chercherId($dbh, $table, $name) {
    $query = 'SELECT `id` from `'.$table.'` where LOWER(`nom`)=LOWER(\''.$name.'\')';
    $result = $dbh->query($query);
    if ($result) { 
        foreach($result as $row) {
            return $row['id'];
        }
    } else {
        return FALSE;        
    }
}

function listerUsers($dbh) {
    $res = $dbh->query('SELECT nom from ph_users where 1');
    $array = array();
    if ($res) { 
        foreach($res as $row) {
            $array[] = $row['nom'];
        }
    }
    return $array;
}


function listerUsersJS() {
    $dbh = connectBD();
    $res = $dbh->query('SELECT nom from ph_users where 1');
    $array = array();
    if ($res) { 
        foreach($res as $row) {
            $array[] = $row['nom'];
        }
    }
    echo "[\"".implode('","', $array)."\"]";
    // Ferme la connexion à la DB
    $dbh = null;
}

function afficherTableDiv() {
    $dbh = connectBD();

    echo '<div class="table-wrapper"><table><thead><tr><th>Médicament</th><th>Quantité</th><th>Date de péremption</th><th>Proposé par</th></tr></thead>';
    $res = $dbh->query('SELECT ph_medocs.nom as med, ph_pharmacie.quantite as qte, ph_pharmacie.datePeremption as per, ph_users.nom as nom, ph_users.tel as tel FROM ph_users, ph_medocs, ph_pharmacie WHERE ph_users.id = ph_pharmacie.userId AND ph_medocs.id = ph_pharmacie.medocId');
    echo " <tbody>";
    if ($res) {
        foreach($res as $row) {
            echo sprintf('  <tr><td>%s</td><td>%s</td><td>%s</td><td>%s (%s)</td></tr>', 
                    $row["med"], $row["qte"], $row["per"], $row["nom"], $row["tel"]);
        }
    } else {
        // zero rows
        echo '<tr><td> </td><td> Pas de médicament</td></tr>'; 
    }
    echo "  </tbody></table></div>\n";
    // Ferme la connexion à la DB
    $dbh = null;
}


function afficherTableRecherche($nomMed) {
    $dbh = connectBD();

    echo '<div class="table-wrapper"><table><thead><tr><th>Médicament</th><th>Quantité</th><th>Date de péremption</th><th>Proposé par</th></tr></thead>';
	$query =  'SELECT ph_medocs.nom as med, ph_pharmacie.quantite as qte, ph_pharmacie.datePeremption as per, ph_users.nom, ph_users.tel as tel';
	$query .= ' FROM ph_users, ph_medocs, ph_pharmacie';
    $query .= ' WHERE ph_users.id = ph_pharmacie.userId AND ph_medocs.id = ph_pharmacie.medocId';
	if (!empty($nomMed)) { $query .= ' AND ph_medocs.nom LIKE "%'.$nomMed.'%"'; }
	$query .= ' ORDER BY ph_medocs.nom asc';
    $res = $dbh->query($query);
    echo " <tbody>";
    if ($res) {
        foreach($res as $row) {
            echo sprintf('  <tr><td>%s</td><td>%s</td><td>%s</td><td>%s (%s)</td></tr>', 
                    $row["med"], $row["qte"], $row["per"], $row["nom"], $row["tel"]);
        }
    } else {
        // zero rows
        echo '<tr><td> </td><td> Pas de médicament trouvés contenant "'.$nomMed.'"</td></tr>'; 
    }
    echo "  </tbody></table></div>";
    // Ferme la connexion à la DB
    $dbh = null;
}

function afficherTable() {
    $dbh = connectBD();
    echo "<table>\n <thead><tr><th>Médicament</th><th>Quantité</th><th>Date de péremption</th><th>Proposé par</th></tr></thead>";
    $res = $dbh->query('SELECT ph_medocs.nom as med, ph_pharmacie.quantite as qte, ph_pharmacie.datePeremption as per, ph_users.nom as nom ph_users.tel as tel FROM ph_users, ph_medocs, ph_pharmacie WHERE ph_users.id = ph_pharmacie.userId AND ph_medocs.id = ph_pharmacie.medocId');
    echo " <tbody>";
    if ($res) {
        foreach($res as $row) {
            echo sprintf('  <tr><td>%s</td><td>%s</td><td>%s</td><td>%s (%s)</td></tr>', 
                    $row["med"], $row["qte"], $row["per"], $row["nom"], $row["tel"]);
        }
    } else {
        // zero rows
        echo '  <tr><td>-</td><td>Pas de médicament</td><td>-</td><td>-</td></tr>'; 
    }
    echo "  </tbody>\n</table>\n";
    // Ferme la connexion à la DB
    $dbh = null;
}

function ajouterUser($dbh, $nom, $tel, $mail) {
    // Cherche le nom du User : 
    // s'il existe renvoie l'id du user
    // Sinon crée l'user et renvoie l'id
    $id = chercherId($dbh, 'ph_users', $nom);
    if ($id) {
        // Utilisateur existant
        // màj user si nécessaire
        majUser($dbh, $id,$tel,$mail);
    } else {
        // création user
        $query = "INSERT INTO `ph_users` VALUES ('', '$nom', '$tel', '$mail')";
        $res = $dbh->query($query);
        if ($res) { $id = chercherId($dbh, 'ph_users', $nom); } 
        else { echo "pb ajouterUser"; }
    }
    return $id;
}

function majUser($dbh, $id,$tel,$mail) {
    $query = 'SELECT `tel`, `mail` from `ph_users` where id='.$id;
    $result = $dbh->query($query);
    if ($result) { 
        $setVals = array();
        $row = $result->fetch();
        if (!empty($tel) && $tel!=$row['tel']) {
            $setVals[] = '`tel`='.$tel;
        }
        if (!empty($mail) && $mail!=$row['mail']) {
            $setVals[] = '`mail`='.$mail;
        }
        if (!empty($setVals)) {
            $query = sprintf('UPDATE `ph_users` SET %s  where id=%s', implode(", ", $setVals), $id);
            $dbh->query($query);
        }
    } else {
        return FALSE;
    }
}

function ajouterMedoc($dbh, $med) {
    // Cherche le nom du User : 
    // s'il existe renvoie l'id du user
    // Sinon crée l'user et renvoie l'id
    $id = chercherId($dbh,'ph_medocs', $med);
    if (!$id) {
        // création medoc
        $query = "INSERT INTO `ph_medocs` VALUES ('', '$med', '')";

        if ($dbh->query($query)) { $id = chercherId($dbh,'ph_medocs', $med); } 
        else { echo "pb ajouterMedoc"; }
    }
    return $id;   
}

function ajouterPharma($nom, $med, $tel, $mail, $qtite, $peremption) {
    $dbh = connectBD();
    // Recherche user
    $userId = ajouterUser($dbh, $nom, $tel, $mail);
	// Recherche med
    $medId = ajouterMedoc($dbh, $med);
    // Ajout table pharmacie
    $query = "INSERT INTO `ph_pharmacie` VALUES ('', '$userId', '$medId', '$qtite', '$peremption')";
    if ($dbh->query($query)) { echo "ajouterPharma ok"; } 
    else { echo "pb ajouterPharma"; }
    // Ferme la connexion à la DB
    $dbh = null;
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>