<html>
<?php
require_once './includes/head.php';
require_once './mesClasses/Cvisiteurs.php';
require_once './mesClasses/Crapport.php';
require_once 'includes/functions.php';

session_start();

$ovisiteur = unserialize($_SESSION['visitauth']);
?>

<body>
        <div class='container'>
            <header title="saisirRapport">
            </header>

            <?php

            require_once 'includes/navBar.php';

            ?>

            <?php
            $formAction = $_SERVER['PHP_SELF'];
            require_once 'includes/form_rapport.php';
            
            ?>
            <br>
            <?php
            require_once 'includes/afficheRapport.php';
            require 'includes/gestion-erreur.php';

            ?>
        </div>
    </body>


    </tbody>
    </table>




    </div>
</body>

</html>