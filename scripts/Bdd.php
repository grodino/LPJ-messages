<?php

class Bdd{
	private $bdd;
	private $resultats;
	private $reponse;

	// Constructeur : créé une connexion bdd
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
	public function existCookie($cookie){
		$req = $this->bdd->prepare("SELECT* FROM messages WHERE cookie = ?");
		$req->execute(array($cookie));

		$resultat = $req->fetchAll();

		try {
			if (count($resultat) >= 2) {
				throw new Exception('Deux cookies ont la même valeur, veuillez me contacter');
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

	// Retourne true si l'adresse ip existe
	public function existIp($ip){
		$req = $this->bdd->prepare("SELECT* FROM messages WHERE ip = ?");
		$req->execute(array($ip));

		$this->resultats = $req->fetchAll();

		 if ($this->resultats == null) {
			$this->reponse = false;
		} else {
			$this->reponse = true;
		}

		return $this->reponse;
	}

	// Retourne le nombre de modifications restantes sur le cookie
	public function getNbModifsCookie($cookie) {
		$req = $this->bdd->prepare("SELECT nb_modifications FROM messages WHERE cookie = ?");
		$req->execute(array($cookie));

		$this->resultats = $req->fetchAll();

		return $this->resultats;
	}

	// Retourne le nombre de modifications restantes sur l'ip
	public function getNbModifsIp($ip) {
		$req = $this->bdd->prepare("SELECT nb_modifications FROM messages WHERE ip = ?");
		$req->execute(array($ip));

		$this->resultats = $req->fetchAll();

		return $this->resultats;
	}

	// Met à jours la valeur du nombre de modifications
	public function updateNbModifs($nouvelleValeur) {
		$req = $this->bdd->prepare("UPDATE messages SET nb_modifications = ?");
		$req->execute(array($nouvelleValeur));
	}

	// Retourne true s'il le message en param existe déja
	public function verifierMessage($message) {
		$req = $this->bdd->prepare("SELECT message FROM messages WHERE message = ?");
		$req->execute(array($message));

		$this->resultats = $req->fetchAll();

		if ($this->resultats == null) {
			$this->reponse = false;
		} else {
			$this->reponse = true;
		}

		return $this->reponse;
	}
}




























