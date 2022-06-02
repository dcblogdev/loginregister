<?php
class User 
{
	private $_db;
	private $_ignoreCase;

	function __construct($db)
	{
		$this->_db = $db;
		$this->_ignoreCase = false;
	}
	
	public function setIgnoreCase($sensitive) {
		$this->_ignoreCase = $sensitive;
	}

	public function getIgnoreCase() {
		return $this->_ignoreCase;
	}

	private function get_user_hash($username)
	{
		$str_where = ($this->_ignoreCase) ? "LOWER(username) = LOWER(:username)" : "username = :username";
		return $this->_db->q(
			'SELECT password, username, memberID FROM members WHERE '.$str_where.' AND active="Yes" ',
			['username' => $username]
		);
	}

	public function isValidUsername($username)
	{
		return !(strlen($username) < 3 || strlen($username) > 17 || !ctype_alnum($username));
	}

	public function login($username, $password)
	{
		if (!$this->isValidUsername($username) || strlen($password) < 3) return false;

		$row = $this->get_user_hash($username);

		if (isset($row['password']) && password_verify($password, $row['password'])) {

			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $row['username'];
			$_SESSION['memberID'] = $row['memberID'];
		    
			return true;
		}
		return false;
	}

	public function logout()
	{
		session_destroy();
	}

	public function is_logged_in()
	{
		return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;
	}

	public function getUsername(){
		return htmlspecialchars($_SESSION['username'], ENT_QUOTES);
	}

	public function getMemberID(){
		return $_SESSION['memberID'];
	}

}
