<?php

class ErreurInfo extends Exception {

	// Gère les exceptions plus joliment
	public function declarerException() {
		header('Location: ../index.php?erreur='.htmlspecialchars($this->getMessage()));
	}

	// Affiche une exception sur le client
	public function afficherException() {
		echo '<div class="erreur"> Oops une erreur est survenue : '.htmlspecialchars($_GET['erreur']).'</div>';
	}
}