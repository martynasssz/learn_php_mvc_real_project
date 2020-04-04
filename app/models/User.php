<?php
class User {
	private $db;

	public function __construct(){
		$this->db = new Database; //intiate class
	}

	// Find user my email
	public function findUserByEmail($email) {  //pass email from a controller
		$this->db->query('SELECT * FROM users WHERE email = :email');
	//Bind value to the email
		$this->db->bind(':email', $email);

		$row = $this->db->single();

		// Check row
		if($this->db->rowCount()> 0){ // rowCount()> 0 means that email found
			return true;
		} else {
			return false;
		}
	}
}