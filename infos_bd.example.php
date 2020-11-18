<?php

  /**
   *
   * Connect to database
   *
   * @param    none
   * @return   dbh $dbh handle to database connection (PDO object)
   *
   */
  function connectBD() {
    $choixId = "local"; /* "mon.site"; /* */
   /* Variables */
   if ($choixId=="local")
    { 
      $dbh = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    }
    elseif ($choixId=="mon.site") {
        $dbh = new PDO('mysql:host=mon.site.fr;dbname=ma.base;charset=utf8', 'nom.user', 'm.d.p');
    } else {
      die('Site inconnu');
    }

    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $dbh;
  }

?>

