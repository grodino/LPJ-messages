<?php

class AntiSpam{
  	private $nbModifRestantes;
	private $cookie;
	private $adresseIp;

	function AntiSpam($cookie, $adresseIp){
		$this->cookie = $cookie;
		$this->adresseIp = $adresseIp;
	}

	// Retourne le nombre de modification restantes (de 3 à 0) TODO : refaire
	public function nbModifRestantes() {
		$demande = "SELECT nb_modif FROM message_lpj WHERE cookie = ?";
	}

	public function verifierCookie() {
		$requete = new Bdd();

		return $requete->existCookie($this->cookie);
	}
}