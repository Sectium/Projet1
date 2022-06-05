<html>
<?php
require_once './includes/head.php';
require_once './mesClasses/Cvisiteurs.php';
require_once 'includes/functions.php';

session_start();

$ovisiteur = unserialize($_SESSION['visitauth']);
?>
<body>
        <div class='container'>
            <header title="profilVisiteur">
            </header>

            <?php

            require_once 'includes/navBar.php';

            ?>
            <br>
            <?php
            require 'includes/infosVisiteur.php';
            require 'includes/gestion-erreur.php';

            ?>
        </div>
    </body>