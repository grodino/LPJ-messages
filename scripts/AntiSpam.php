<?php

class AntiSpam{
  	private $nbModifRestantes;
	private $nbModifs;
	private $existCookie;
	private $bdd;
	private $cookie;
	private $message;

	function __construct($cookie, $message){
		$this->bdd = new Bdd();
		$this->cookie = $cookie;
		$this->message = $message;

		$this->nbModifRestantes();

		try {
			if ($this->bdd->verifierMessage($this->message)) {
				throw new Exception('Votre message est identique à celui de quelqu\'un d\'autre, soyez original ! ;)');
			}
		} catch (Exception $e) {
			$info = new ErreurInfo($e->getMessage());
			$info->declarerException();
		} // On vérifie si ce n'est pas le même message que quelqu'un d'autre

	}

	// Enregistre le nombre de modification restantes et le nombre de modifications effectuées et les crées si c'est un nouvel écrivain
	private function nbModifRestantes() {
		// On vérifie si le cookie que l'on a est dans la base
		if ($this->bdd->existCookie($this->cookie)) { // Si oui on récupère le nombre de modifications qui ont été faites
			$this->nbModifs = $this->bdd->getNbModifsCookie($this->cookie);
			$this->nbModifRestantes = 3 - $this->nbModifs;

		} else {
			$this->nbModifs = 0;
			$this->nbModifRestantes = 3 - $this->nbModifs;

		}

	}

	// Persiste tout en base de donnée si tout c'est déroulé correctement
	public function persistAll() {
		try {
			if ($this->nbModifRestantes > 0) {
				if ($this->nbModifs == 0) {
					$this->bdd->createMessage($this->cookie, $this->message);
				} else {
					$this->bdd->updateMessage($this->message, $this->cookie);
				}

				$this->bdd->updateNbModifs($this->nbModifs + 1, $this->cookie);
			} else {
				throw new Exception('Vous ne pouvez pas modifier votre message plus de trois fois !');
			}
		} catch (Exception $e) {
			$info = new ErreurInfo($e->getMessage());
			$info->declarerException();
		}

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