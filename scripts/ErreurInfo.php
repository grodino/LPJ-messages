<?php

class ErreurInfo {
	private $message;

	function __construct($message){
		$this->message = $message;
	}

	// Gère les exceptions plus joliment
	public function declarerException() {
		header('Location: ../index.php?erreur='.htmlspecialchars($this->message));
		exit();
	}

	public function declarerValidation() {
		header('Location: ../index.php?info='.htmlspecialchars($this->message));
		exit();
	}

	// Affiche une exception sur le client
	public function afficherException() {
		if (isset($_GET['erreur'])) {
			echo '<div class="erreur"> Oops une erreur est survenue : '.htmlspecialchars($_GET['erreur']).'</div>';
		}
	}

	public function afficherValidation() {
		if (isset($_GET['info'])) {
			echo '<div class="info">'.htmlspecialchars($_GET['info']).'</div>';
		}
	}
}