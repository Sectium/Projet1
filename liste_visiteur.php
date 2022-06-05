<html>
    <?php 
        require_once 'includes/head.php';
        require_once './mesClasses/Cvisiteurs.php';
        
        session_start();
        
        $ovisiteur = unserialize($_SESSION['visitauth']);
        
    ?>
    <body>
        <?php
        $ovisiteurs = new Cvisiteurs();
        $ocoll = $ovisiteurs->getVisiteursTrie('nom');
        //$ocoll = array_reverse($ocoll); tableau décroissant
        
        $ovisiteurs = new Cvisiteurs();
        $ocollVille = $ovisiteurs->getVisiteursTrie('ville');
        $tabVille = array();
        foreach($ocollVille as $ovisiteur){
            $tabVille[] = $ovisiteur->ville;
        }
        
        $ocollVilles = array_unique($tabVille, SORT_REGULAR);
        ?>
        
        
        <div class="container">
            <header title="listevisiteur"></header>
            
            <?php
            
            require_once 'includes/navBar.php';
            
            ?>
            
            <br>
            
            <div title="choixVille">
                <form method="post">
                    <label for="listeChoixVille">Choix de la ville : </label>
                    <select id="listeChoixVille" name="listeChoixVille">
                        <option selected value="toutes">Toutes</option>
                        <?php 
                        foreach ($ocollVilles as $ville){ ?>
                        <option id="<?php $ville ?>"><?php echo $ville; ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <br>
                
                    <input type="text" name="partieNom">
                    
                    <input type="radio" name="drone" value="debut">Début
                
                    <input type="radio" name="drone" value="fin">Fin
                
                    <input type="radio" name="drone" value="n'importe">Dans la chaîne
                    
                
                    <input type="submit" value="filtrer">   
                </form> 
            </div>
            <br>
            <br>
                <?php 
                /*$debutFin = "debut";
                $partieNom = "a";
                $ville = "toutes";
                if (isset($_GET['drone']) && isset($_GET['partieNom'])){
                    $debutFin = $_GET['drone'];
                    $partieNom = $_GET['partieNom'];
                    
                }*/
                if (isset($_POST['drone']) && isset($_POST['partieNom']) && isset($_POST['listeChoixVille'])) {
                    
                    
                
                $ovisiteurs = new Cvisiteurs();
                $afficheVisiteur = $ovisiteurs->getTabVisiteursParNomEtVille($_POST['drone'], $_POST['partieNom'], $_POST['listeChoixVille']);
                ?>
            
            <br>
            <p title="tabvisiteur">Tableau des visiteurs : ( <?php echo count($afficheVisiteur); ?> )</p>
            <table class="table table-condensed">
                <thead title="entetetabvisiteur">
                    <tr>
                        <th>ID</th>
                        <th>LOGIN</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>VILLE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=0;
                        foreach ($afficheVisiteur as $ovisiteur)
                        { 
                            $i++;
                            if ($i%2 < 1){ ?>
                            <tr class="ligneTabVisitColor">
                                <td><?php echo $ovisiteur->id?></td>
                                <td><?php echo $ovisiteur->login?></td>
                                <td><?php echo $ovisiteur->nom?></td>
                                <td><?php echo $ovisiteur->prenom?></td>
                                <td><?php echo $ovisiteur->ville?></td>
                            </tr>
                                <?php } else{ ?>
                            <tr>
                                <td><?php echo $ovisiteur->id?></td>
                                <td><?php echo $ovisiteur->login?></td>
                                <td><?php echo $ovisiteur->nom?></td>
                                <td><?php echo $ovisiteur->prenom?></td>
                                <td><?php echo $ovisiteur->ville?></td>
                            </tr>
                               
                           <?php
                           
                           } 
                        }
                        
                        
                        ?>
                </tbody>
            </table>
        
        
        <?php }else{
        ?>
            <p title="tabvisiteur">Tableau des visiteurs : ( <?php echo count($ocoll); ?> )</p>
            <table class="table table-condensed">
                <thead title="entetetabvisiteur">
                    <tr>
                        <th>ID</th>
                        <th>LOGIN</th>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>VILLE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=0;
                        foreach ($ocoll as $ovisiteur)
                        { 
                            $i++;
                            if ($i%2 < 1){ ?>
                            <tr class="ligneTabVisitColor">
                                <td><?php echo $ovisiteur->id?></td>
                                <td><?php echo $ovisiteur->login?></td>
                                <td><?php echo $ovisiteur->nom?></td>
                                <td><?php echo $ovisiteur->prenom?></td>
                                <td><?php echo $ovisiteur->ville?></td>
                            </tr>
                                <?php } else{ ?>
                            <tr>
                                <td><?php echo $ovisiteur->id?></td>
                                <td><?php echo $ovisiteur->login?></td>
                                <td><?php echo $ovisiteur->nom?></td>
                                <td><?php echo $ovisiteur->prenom?></td>
                                <td><?php echo $ovisiteur->ville?></td>
                            </tr>
                               
                           <?php
                           
                           } 
                        }
                        
                        
                        ?>
                </tbody>
            </table>
        <?php } ?>
            
        </div>
    </body>
</html>