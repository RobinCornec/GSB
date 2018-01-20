<?php
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
    
if( $_SESSION['Poste'] != 'Employe' && $_SESSION['Poste'] == 'Admin')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilAdmin.php">Accéder à l\'accueil Admin</a>';
}
else if($_SESSION['Poste'] == 'Comptable')
{
    echo 'Vous n\'etes pas autorisés à accéder à cette page';
    echo '<br><a href="AccueilComptable.php">Accéder à l\'accueil comptable</a>';  
}    
else {    
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gestion des frais de visite - GSB</title>
    <link href="CSS/SaisieFrais.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet" type="text/css" />
    <script>
        function ajoutLigne(pNumero) {//ajoute une ligne de produits/qté à la div "lignes"     
            //masque le bouton en cours
            document.getElementById("but" + pNumero).setAttribute("hidden", "true");
            pNumero++;										//incrémente le numéro de ligne
            var laDiv = document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
            var titre = document.createElement("label");	//crée un label
            laDiv.appendChild(titre);						//l'ajoute à la DIV
            titre.setAttribute("class", "titre");			//définit les propriétés
            titre.innerHTML = "   " + pNumero + " : ";
            //zone our la date du frais
            var ladate = document.createElement("input");
            laDiv.appendChild(ladate);
            ladate.setAttribute("name", "FRA_AUT_DAT" + pNumero);
            ladate.setAttribute("size", "12");
            ladate.setAttribute("class", "zone");
            ladate.setAttribute("type", "text");
            //zone de saisie pour un nouveau libellé			
            var libelle = document.createElement("input");
            laDiv.appendChild(libelle);
            libelle.setAttribute("name", "FRA_AUT_LIB" + pNumero);
            libelle.setAttribute("size", "30");
            libelle.setAttribute("class", "zone");
            libelle.setAttribute("type", "text");
            //zone de saisie pour un nouveau montant		
            var mont = document.createElement("input");
            laDiv.appendChild(mont);
            mont.setAttribute("name", "FRA_AUT_MONT" + pNumero);
            mont.setAttribute("size", "3");
            mont.setAttribute("class", "zone");
            mont.setAttribute("type", "text");
            var bouton = document.createElement("input");
            laDiv.appendChild(bouton);
            //ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
            bouton.setAttribute("onClick", "ajoutLigne(" + pNumero + ");");
            bouton.setAttribute("type", "button");
            bouton.setAttribute("value", "+");
            bouton.setAttribute("class", "zone");
            bouton.setAttribute("id", "but" + pNumero);
        }
    </script>
</head>
<body>
    <header>
        <a href="Accueil.html">
            <img src="GSB.png" alt="Logo GSB"/>
        </a>
        <h1>Suivi du remboursement des frais</h1>

        <div id="User">
            <?php
            echo '<b>'.$_SESSION['Prenom'].' '.$_SESSION['Nom'].'</b>';
            ?>
            <img src="Avatar.jpg" />
            <ul>
                <li>------------------</li>
                <li><a href="http://localhost/GSB/Appli/Deconnexion.php">Déconnexion</a></li>
            </ul>
        </div>

    </header>
    <div id="Navi">

        <div id="BoutonOutils">
            <a id="Outils" href="javascript: deplacer(0)">Consulter </a>
        </div>
        <a href="javascript: deplacer(-304)">× </a>
        <h2>Consulter une fiche de frais</h2>
        <form method="post" action="">
            <select name="Mois"> 
                <option>Janvier</option>
                <option>Fevrier</option>
                <option>Mars</option>
                <option>Avril</option>
                <option>Mai</option>
                <option>Juin</option>
                <option>Juillet</option>
                <option>Aout</option>
                <option>Septembre</option>
                <option>Octobre</option>
                <option>Novembre</option>
                <option>Décembre</option>
            </select>
            <input type="text" name="annee" />
            <input value="Valider" type="submit" />
        </form>
    </div>

    <div id="Blabla">


        <form name="formSaisieFrais" method="post" action="enregSaisieFrais.php">
            <h2><b>Saisie</b></h2>
            <label class="titre">PERIODE D'ENGAGEMENT :</label>
            <label style="float: left;">Mois (2 chiffres) : </label>
            <input type="text" size="4" name="FRA_MOIS" class="zone" />
            <label style="float: left;">&nbsp;Année (4 chiffres) : </label>
            <input type="text" size="4" name="FRA_AN" class="zone" />
            <p class="titre" />

            <h2>Frais au forfait</h2>
            <label class="titre">Repas midi :</label>
            <input type="text" size="2" name="FRA_REPAS" class="zone" />
            <label class="titre">Nuitées :</label>
            <input type="text" size="2" name="FRA_NUIT" class="zone" />
            <label class="titre">Etape :</label>
            <input type="text" size="5" name="FRA_ETAP" class="zone" />
            <label class="titre">Km :</label>
            <input type="text" size="5" name="FRA_KM" class="zone" />

            <h2>Hors Forfait</h2>
            <div id="HAHA">
                <div style="float: left; width: 90px; text-align: center;">Date</div>
                <div style="float: left; width: 220px; text-align: center;">Libellé</div>
                <div style="float: left; width: 30px; text-align: center;">Montant</div>
            </div>
            <div style="clear: left;" id="lignes">
                <label class="titre">1 : </label>
                <input type="text" size="12" name="FRA_AUT_DAT1" class="zone" />
                <input type="text" size="30" name="FRA_AUT_LIB1" class="zone" />
                <input class="zone" size="3" name="FRA_AUT_MONT1" type="text" />
                <input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />
            </div>
            <p class="titre" />
            <label class="titre">&nbsp;</label><input class="zone" type="reset" /><input class="zone" type="submit" />
        </form>
    </div>
</body>
</html>

<?php } ?>
