<?php

class Client{
  	private $cookie;
	private $adresseIp;
	private $message;
	private $antiSpam;

	// Constructeur TODO : tout
	function __construct(){
		$this->getMessageClient();
		$this->getIpClient();
		$this->getCookieClient();
		$this->antiSpam = new AntiSpam($this->cookie, $this->adresseIp);
	}

	// Retrouve l'ip du client et l'inscrit dans l'objet /!\ A MODIFIER VOIR INTERIEUR
	private function getIpClient() {
		$this->adresseIp = htmlspecialchars($_SERVER['REMOTE_ADDR']);
	}

	// Retrouve le cookie présent sur le client ou en créé un et l'enregistre dans l'instance
	private function getCookieClient() {
		if (isset($_COOKIE['modification'])) {
			$this->cookie = $_COOKIE['modification'];
		} else {
			$this->cookie = $this->setCookieClient();
		}
	}

	// Mets un cookie de 2 mois et l'enregistre dans l'instance
	private function setCookieClient() {
		$this->cookie = sha1(uniqid('', true));
		setcookie('modification', $this->cookie, time() + 60*60*24*31*2, null, null, false, true);
	}

	// Récupère le message (d'amour :D)
	private function getMessageClient() {
		try {
			if (isset($_POST['message']) && $_POST['message'] != '') {
				$this->message = htmlspecialchars($_POST['message']);
			} else {
				throw new Exception('Attention ! Votre message ne doit pas être vide !');
			}
		} catch (Exception $e) {
			echo 'Un problème est survenu : ', $e->getMessage();
			exit();
		}

	}

	// Affiche les infos de l'objet (pour débugger uniquement)
	public function afficherInfos() {
		echo 'Cookie : ', $this->cookie, '<br />';
		echo 'Adresse Ip : ', $this->adresseIp, '<br />';
		echo 'Message : ', nl2br($this->message), '<br />';
	}

	/*
	 * GETTERS
	*/

	// Retrourne l'adresse ip
	public function getIp() {
		return $this->adresseIp;
	}

	// Retourne le cookie
	public function getCookie() {
		return $this->cookie;
	}

	// Retourne le message
	public function getMessage() {
		return $this->message;
	}
}