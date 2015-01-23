<?php

class AntiSpam extends Client{
  	private $nbModifRestantes;
	private $nbModifs;
	private $bdd;

	function __construct(){
		$this->bdd = new Bdd();
		$this->nbModifRestantes();

		try {
			if ($this->verifierMessages()) {
				throw new Exception('Votre message est identique à celui de quelqu\'un d\'autre, soyez original ! ;)');
			}
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		} // On vérifie si ce n'est pas le même message que quelqu'un d'autre

	}

	// Enregistre le nombre de modification restantes et le nombre de modifications effectuées et les crées si c'est un nouvel écrivain
	private function nbModifRestantes() {
		// On vérifie si le cookie que l'on a est dans la base
		if ($this->bdd->existCookie($this->cookie)) { // Si oui on récupère le nombre de modifications qui ont été faites
			$this->nbModifs = $this->bdd->getNbModifsCookie();
			$this->nbModifRestantes = 3 - $this->nbModifs;

		} else if ($this->bdd->existIp($this->adresseIp)) { // S'il n'existe pas de cookie (supprimé par l'utilisateur par exemple) on vérifie s'il existe l'ip et si ip on remet un cookie
			$this->nbModifs = $this->bdd->getNbModifsIp($ip);
			$this->nbModifRestantes = 3 - $this->nbModifs;

			$this->setCookieClient();
		} else {
			$this->nbModifs = 0;
			$this->nbModifRestantes = 3 - $this->nbModifs;

			$this->setCookieClient();
		}
	}

	// Vérifie s'il n'y a pas deux même messages
	private function verifierMessages() {
		return $this->bdd->verifierMessage();
	}

	// Persiste tout en base de donnée si tout c'est déroulé correctement
	public function persistAll() {

	}


	/*
	 * GETTERS
	*/

	// Retoure le nombre de modification restantes
	public function getNbModifRestantes() {
		return $this->nbModifRestantes;
	}

	// Retourne le nombre de modifications
	public function getNbModifs() {
		return $this->nbModifs;
	}
}