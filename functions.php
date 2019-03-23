<?php
include("infos_bd.php");

function chercherId($table, $name) {
    $query = 'SELECT `id` from `'.$table.'` where LOWER(`nom`)=LOWER(\''.$name.'\')';
    $result = mysql_query($query);
    if ($result) { 
        $row = mysql_fetch_assoc($result);
        return $row['id'];
    } else {
        return FALSE;        
    }
}

function listerUsers() {
    $res = mysql_query('SELECT nom from ph_users where 1');
    $array = array();
    if ($res) { 
           while($row = mysql_fetch_assoc($res)) {
            $array[] = $row['nom'];
        }
    }
    return $array;
}


function listerUsersJS() {
    connectBD();
    $res = mysql_query('SELECT nom from ph_users where 1');
    $array = array();
    if ($res) { 
        while($row = mysql_fetch_assoc($res)) {
            $array[] = $row['nom'];
        }
    }
    echo "[\"".implode('","', $array)."\"]";
    mysql_close();
}

function afficherTableDiv() {
    connectBD();

    echo '<div class="table-wrapper"><table><thead><tr><th>Médicament</th><th>Quantité</th><th>Date de péremption</th><th>Proposé par</th></tr></thead>';
    $res = mysql_query('SELECT ph_medocs.nom as med, ph_pharmacie.quantite as qte, ph_pharmacie.datePeremption as per, ph_users.nom as nom, ph_users.tel as tel FROM ph_users, ph_medocs, ph_pharmacie WHERE ph_users.id = ph_pharmacie.userId AND ph_medocs.id = ph_pharmacie.medocId');
    echo " <tbody>";
    if ($res) {
        while($row = mysql_fetch_assoc($res)) {
            echo sprintf('  <tr><td>%s</td><td>%s</td><td>%s</td><td>%s (%s)</td></tr>', 
                    $row["med"], $row["qte"], $row["per"], $row["nom"], $row["tel"]);
        }
    } else {
        // zero rows
        echo '<tr><td> </td><td> Pas de médicament</td></tr>'; 
    }
    echo "  </tbody></table></div>\n";
    mysql_close();
}

function afficherTable() {
    connectBD();
    echo "<table>\n <thead><tr><th>Médicament</th><th>Quantité</th><th>Date de péremption</th><th>Proposé par</th></tr></thead>";
    $res = mysql_query('SELECT ph_medocs.nom as med, ph_pharmacie.quantite as qte, ph_pharmacie.datePeremption as per, ph_users.nom as nom ph_users.tel as tel FROM ph_users, ph_medocs, ph_pharmacie WHERE ph_users.id = ph_pharmacie.userId AND ph_medocs.id = ph_pharmacie.medocId');
    echo " <tbody>";
    if ($res) {
        while($row = mysql_fetch_assoc($res)) {
            echo sprintf('  <tr><td>%s</td><td>%s</td><td>%s</td><td>%s (%s)</td></tr>', 
                    $row["med"], $row["qte"], $row["per"], $row["nom"], $row["tel"]);
        }
    } else {
        // zero rows
        echo '  <tr><td>-</td><td>Pas de médicament</td><td>-</td><td>-</td></tr>'; 
    }
    echo "  </tbody>\n</table>\n";
    mysql_close();
}

function ajouterUser($nom, $tel, $mail) {
    // Cherche le nom du User : 
    // s'il existe renvoie l'id du user
    // Sinon crée l'user et renvoie l'id
    $id = chercherId('ph_users', $nom);
    if ($id) {
        // Utilisateur existant
        // màj user si nécessaire
        majUser($id,$tel,$mail);
    } else {
        // création user
        $query = "INSERT INTO `ph_users` VALUES ('', '$nom', '$tel', '$mail')";
        if (mysql_query($query)) { $id = chercherId('ph_users', $nom); } 
        else { echo "pb ajouterUser"; }
    }
    return $id;
}

function majUser($id,$tel,$mail) {
    $query = 'SELECT `tel`, `mail` from `ph_users` where id='.$id;
    $result = mysql_query($query);
    if ($result) { 
        $setVals = array();
        $row = mysql_fetch_assoc($result);
        if (!empty($tel) && $tel!=$row['tel']) {
            $setVals[] = '`tel`='.$tel;
        }
        if (!empty($mail) && $tel!=$row['mail']) {
            $setVals[] = '`mail`='.$mail;
            $result = mysql_query($query);
        }
        if (!empty($setVals)) {
            $query = sprintf('UPDATE `ph_users` SET %s', implode(", ", $setVals));
            $result = mysql_query($query);
        }

    } else {
        return FALSE;        
    }
}

function ajouterMedoc($med) {
    // Cherche le nom du User : 
    // s'il existe renvoie l'id du user
    // Sinon crée l'user et renvoie l'id
    $id = chercherId('ph_medocs', $med);
    if (!$id) {
        // création medoc
        $query = "INSERT INTO `ph_medocs` VALUES ('', '$med', '')";
        if (mysql_query($query)) { $id = chercherId('ph_medocs', $med); } 
        else { echo "pb ajouterMedoc"; }
    }
    return $id;   
}

function ajouterPharma($nom, $med, $tel, $mail, $qtite, $peremption) {
    connectBD();
    // Recherche user
    $userId = ajouterUser($nom, $tel, $mail);
	// Recherche med
    $medId = ajouterMedoc($med);
    // Ajout table pharmacie
    $query = "INSERT INTO `ph_pharmacie` VALUES ('', '$userId', '$medId', '$qtite', '$peremption')";
    if (mysql_query($query)) { echo "ajouterPharma ok"; } 
    else { echo "pb ajouterPharma"; }
    mysql_close();
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>