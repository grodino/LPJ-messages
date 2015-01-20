<?php

class Bdd{
	private $bdd;
	private $resultats;

	// Constructeur
	function __construct() {
		try
		{
			$this->bdd = new PDO('mysql:host=localhost;dbname=message_lpj', 'root', '');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

	// Retourne true si le cookie existe
	function existCookie($cookie){
		$req = $this->bdd->prepare("SELECT* FROM messages WHERE cookie = ?");
		$req->execute(array($cookie));

		$resultat = $req->fetchAll();

		try {
			if (count($resultat) > 2) {
				throw new Exception('Erreur lors de l\' enregistrement du message, deux cookies ont la même valeur');
			} else if ($resultat == null) {
				$reponse = false;
			} else {
				$reponse = true;
			}
		} catch (Exception $e){
			echo 'Un problème est survenu : ', $e->getMessage();
			exit();
		}

		return $reponse;
	}

}