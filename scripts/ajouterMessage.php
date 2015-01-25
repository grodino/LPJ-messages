<?php

include_once("ErreurInfo.php");
include_once("Bdd.php");
include_once('Client.php');
include_once("AntiSpam.php");

$ecrivain = new Client;
$ecrivain->persisterClient();

$info = new ErreurInfo("Votre message a bien été enregistré ! Il vous reste ".$ecrivain->antiSpam->getNbModifRestantes()." modifications.");
$info->declarerValidation();

// TODO :
// Client
// -> Enregister le cookie dans la bdd en passant par anti-spam
//
// Anti spam
// -> Vérifier le cookie puis si pas en bdd mais sur le client, mettre une erreur (tentative de modif de cookie)
// -> Si cookie ni bdd ni client vérifier ip et si ip en bdd remettre un cookie (supprimé par user?) et modifs - 1
//
// Bdd
// -> vérifier la fonction de requète voire la supprimer
// -> Fonctions de recherche et enregistrement cookie
// -> Idem pour l'ip
// -> Fonction de recherche de nombre de modifs restantes