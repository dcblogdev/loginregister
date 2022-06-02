<?php
/**
 * PDO Class
 */
class DBPDO
{
	private $dbname;
	private $dblogin;
	private $dbpassword;
	private $dbhost;
	private $connect;
	private $error;

	public function __construct($name, $login = "root", $password = "", $host = "localhost"){
		$this->dbname = $name;
		$this->dblogin = $login;
		$this->dbpassword = $password;
		$this->dbhost = $host;
		$this->connexion();
		// Set default SQL
		if(file_exists('includes/db.sql')) $this->q(file_get_contents('includes/db.sql'));
	}

	private function connexion(){
		try{
			$dns = "mysql:host=".$this->dbhost.";dbname=".$this->dbname;
			$bdd = new PDO($dns, $this->dblogin, $this->dbpassword);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$this->connect = $bdd;
			$this->error = "Aucune erreur";
		}
		catch(PDOException $e){
			$this->error = '<br>ERREUR PDO dans '.$e->getFile().' L.'.$e->getLine().' : '.$e->getMessage()."<br>";
			echo '<p class="bg-danger">'.$e->getMessage().'</p>';
			exit;
		}
	}

	public function q($sql, Array $cond = [], $fetch = PDO::FETCH_ASSOC){
		$cps = $this->connect->prepare($sql);
		$cps->execute($cond);
		if(preg_match("/^(SELECT)/", $sql)) return $cps->fetch($fetch);
		$cps->closeCursor();
		$cps = null;
	}

	public function getError(){
		return $this->error;
	}

	public function lastInsertId($str){
		return $this->connect->lastInsertId($str);
	}

	public function getPDO(){
		return $this->connect;
	}
}