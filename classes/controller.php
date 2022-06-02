<?php
include_once('classes/model.php');

class Controller{
    private $model;
    private $user;

    public function __construct($db, $user){
        $this->model = new Model($db);
        $this->user = $user;
    }

    public function getUserById($id){
        return $this->model->getUserById($id);
    }

    public function getUserByName($username){
        if ($this->user->isValidUsername($username)){
            return $this->model->getUserByName($username);
        }
        return false;
    }

    public function getUserByEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $this->model->getUserByEmail($email);
        }
        return false;
    }

    public function getResetToken($token){
        return $this->model->getResetToken($token);
    }

    public function insertUser($username, $password, $email){
		// hash the password
		$hashedpassword = password_hash($password, PASSWORD_BCRYPT);
		// create the activasion code
		$activasion = md5(uniqid(rand(),true));
        // insert
        $id = $this->model->insertUser($username, $hashedpassword, $email, $activasion);

        if($id){
            $subject = "Registration Confirmation";
            $body = "<p>Thank you for registering at demo site.</p>
            <p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
            <p>Regards Site Admin</p>";
            $this->sendEmail($email, $subject, $body);
        }
    }
    
    public function updateToken($email){
		//create the activation code
		$token = md5(uniqid(rand(),true));
        // update
        $this->model->updateToken($email, $token);

        $subject = "Password Reset";
        $body = "<p>Someone requested that the password be reset.</p>
        <p>If this was a mistake, just ignore this email and nothing will happen.</p>
        <p>To reset your password, visit the following address: <a href='".DIR."resetPassword.php?key=$token'>".DIR."resetPassword.php?key=$token</a></p>";
        $this->sendEmail($email, $subject, $body);
    }
    
    public function updatePassword($password, $token){
		//hash the password
		$hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        // update
        $this->model->updatePassword($password, $token);
    }

    public function updateActive($id, $active){
        if($this->model->getUserById($id)){
            return $this->model->updateActive($id, $active);
        }
        return false;
    }

    private function sendEmail($email, $subject, $body){
        $mail = new Mail();
        $mail->setFrom(SITEEMAIL);
        $mail->addAddress($email);
        $mail->subject($subject);
        $mail->body($body);
        $mail->send();
    }
}