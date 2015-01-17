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

	// retourne un tableau avec tous les résultats
	public function rechercher(string $demande, array $arg) {
		$req = $this->bdd->prepare($demande);
		$req->execute($arg);

		$this->resultats = $req->fetchAll();

		return $this->resultats;
	}

}