<?php
include('SQL.php');
session_start(); 
if(!isset($_SESSION['login']))
    {
    header('location: http://localhost/GSB/Appli/SeConnecter.php');
    }
   
    try
           {
                   $connect = new PDO('mysql:host='.$host.';dbname='.$base, $login);
           }
    catch (PDOException $e)
           {
                   exit('problème de connexion à la base');
           }
           
    $requete = 'INSERT INTO lignedefrais (Type,Libelle,Date,Montant,Justificatif) VALUES (:Type,:Libelle,:Date,:Montant,:Justificatif)';
    
    
    
    try
         {
             $req_prep = $connect->prepare($requete);
             
             $req_prep->execute(array(':Type'=>$_POST['Type'],
                                      ':Libelle'=>$_POST['Libelle'],
                                      ':Date'=>$_POST['Date'],
                                      ':Montant'=>$_POST['Montant'],
                                      ':Justificatif'=>$_POST['Justificatif']));
             
             header('location:http://localhost/GSB/Formulaires/SaisirFrais%20-%20NEW.php');
         }    
         catch (PDOException $e)
         {
                $message = 'Problème dans la requête de sélection';
                echo $message;
         }
         
         
    ?>