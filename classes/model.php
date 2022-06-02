<?php
class Model{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getUserById($id){
        return $this->db->q('SELECT username FROM members WHERE memberID = :memberID', [':memberID' => $id]);
    }

    public function getUserByName($username){
        return $this->db->q('SELECT username FROM members WHERE username = :username', [':username' => $username]);
    }

    public function getUserByEmail($email){
        return $this->db->q('SELECT email FROM members WHERE email = :email', [':email' => $email]);
    }

    public function getResetToken($token){
        return $this->db->q('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token', [':token' => $token]);
    }

    public function insertUser($username, $hashedpassword, $email, $activasion){
        $this->db->q(
            'INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)',
            [
                ':username' => $username,
                ':password' => $hashedpassword,
                ':email' => $email,
                ':active' => $activasion
            ]
        );
        return $this->db->lastInsertId('memberID');
    }

    public function updateToken($email, $token){
        $this->db->q(
            "UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email",
            [
                ':email' => $email,
				':token' => $token
            ]
        );
    }

    public function updatePassword($hashedpassword, $token){
        $this->db->q(
            "UPDATE members SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token",
            [
                ':hashedpassword' => $hashedpassword,
				':token' => $token
            ]
        );
    }

    public function updateActive($id, $active){
        $this->db->q(
            "UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active",
            [
                ':memberID' => $id,
		        ':active' => $active
            ]
        );
    }
}