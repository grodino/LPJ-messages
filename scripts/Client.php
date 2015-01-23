<?php

class Client{
  	protected $cookie;
	protected $adresseIp;
	protected $message;
	protected $antiSpam;

	// Constructeur TODO : tout
	function __construct(){
		$this->getMessageClient();
		$this->getIpClient();
		$this->getCookieClient();
		$this->antiSpam = new AntiSpam();
	}

	// Retrouve l'ip du client et l'inscrit dans l'objet /!\ A MODIFIER VOIR INTERIEUR
	private function getIpClient() {
		$this->adresseIp = htmlspecialchars($_SERVER['REMOTE_ADDR']);
	}

	// Retrouve le cookie pr�sent sur le client ou en cr�� un et l'enregistre dans l'instance
	private function getCookieClient() {
		if (isset($_COOKIE['modification'])) {
			$this->cookie = htmlspecialchars($_COOKIE['modification']);
		} else {
			$this->cookie = $this->setCookieClient();
		}
	}

	// R�cup�re le message (d'amour :D)
	private function getMessageClient() {
		try {
			if (isset($_POST['message']) && $_POST['message'] != '' && strlen($_POST['message']) <= 10100) {
				$this->message = htmlspecialchars($_POST['message']);
			} else {
				if (strlen($_POST['message']) >= 10100) {
					throw new Exception('Attention ! Votre message est trop long !');
				} else {
					throw new Exception('Attention ! Votre message ne doit pas �tre vide !');
				}
			}
		} catch (Exception $e) {
			echo 'Un probl�me est survenu : ', $e->getMessage();
			exit();
		}

	}

	// Affiche les infos de l'objet (pour d�bugger uniquement)
	public function afficherInfos() {
		echo 'Cookie : ', $this->cookie, '<br />';
		echo 'Adresse Ip : ', $this->adresseIp, '<br />';
		echo 'Message : ', nl2br($this->message), '<br />';
	}

	// Mets un cookie de 2 mois et l'enregistre dans l'instance
	protected function setCookieClient() {
		$this->cookie = sha1(uniqid('', true));
		setcookie('modification', $this->cookie, time() + 60*60*24*31*2, null, null, false, true);
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