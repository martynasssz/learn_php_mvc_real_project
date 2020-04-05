<?php
class User {
	private $db;

	public function __construct(){
		$this->db = new Database; //intiate class
	}

	// Register User
	public function register($data) {
		$this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
		//Bind values
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);

		// Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}

	// Login User
	public function login($email, $password){
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind('email', $email);

		$row = $this->db->single(); 

		$hashed_password = $row->password; //found hashed passwords in database 
		if(password_verify($password, $hashed_password)){//if passwords (real and hashed passwords) match
			return $row; //when user can login (if match)
		} else {
			return false;
		}  
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