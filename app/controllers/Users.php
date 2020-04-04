<?php
	class Users extends Controller {
		public function __construct(){
			$this->userModel = $this->model('User'); //check model folders for a file user.php

		}
		//   this method handle two things: loading our form and post
		//   we need to check to see is it post request, is form beeing submited ir we just loading it
		public function register(){  
				// Check for post
			if($_SERVER['REQUEST_METHOD'] == 'POST'){ //we chech is it POST, hen we process the form
				// Process form	
					//die('submitted'); check is form submited

				//Sanitize POST data //as strings
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data 
				$data=[
					'name' => trim($_POST['name']), 
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirm_password' => trim($_POST['confirm_password']),
					'name_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => ''
				];	

				// Validate Email
				if(empty($data['email'])){
					$data['email_err'] = 'Please enter email';
				} else { //else means that did enter someting
					// Check email
					if($this->userModel->findUserByEmail($data['email'])){
						$data['email_err'] = 'Email is already taken';
					}	
				}

				// Validate Name
				if(empty($data['name'])){
					$data['name_err'] = 'Please enter name';
				}

				// Validate Password
				if(empty($data['password'])){
					$data['password_err'] = 'Please enter password';
				} elseif(strlen($data['password']) < 6){ //check password length
					$data['password_err'] = 'Password must be at least 6 charancters';
				}

				// Confirm password
				if(empty($data['confirm_password'])){
					$data['confirm_password_err'] = 'Please confirm password';
				} else { 		    //check if matches passwords
					if($data['password'] != $data['confirm_password']){
						$data['confirm_password_err'] = 'passwords do not match';
					}
				}

				// Make sure errors are apty
				if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
					
				// Validated
					            //die('SUCCESS'); //check if everything is ok

				// Hash Password  // STRON ONE WAY HASHING ALGORYTHM
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					// Register User
					if($this->userModel->register($data)){ //when is true we want to rederect to login page
						flash('register_success', 'You are registered and can log in' ); //comes form helper folder and bootstrap.php file //we do not pass a class, we use default class
						redirect('users/login'); //comes form helper folder and bootstrap.php file
					} else {
						die('Something wrong');
					}

				} else {
					// Load view with erros
					$this->view('users/register', $data); //load view with data
				}				
			} else {
				// Init data 
				$data =[   //all set to nothing because is blank register form
					'name' => '', 
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'name_err' => '',
					'email_err' => '',
					'password_err' => '',
					'confirm_password_err' => ''
				];

				// Load view
				$this->view('users/register', $data); //pass data to load form
			}
		}
		
		public function login(){ //we chech is it POST, hen we process the form 
				// Check for post
			if($_SERVER['REQUEST_METHOD'] == 'POST'){ //we chech is it POST, hen we process the form
				// Process form	
				//die('submitted'); //check is form submited
				//Sanitize POST data //as strings
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data 
				$data=[
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),									
					'email_err' => '',
					'password_err' => ''
				];	

				// Validate Email
				if(empty($data['email'])){
					$data['email_err'] = 'Please enter email';
				}

				// Validate password
				if(empty($data['password'])){
					$data['password_err'] = 'Please enter password';
				}

				// Make sure errors are empty
				if(empty($data['email_err']) && empty($data['password_err'])) {
					// Validated
					die('SUCCESS');
				} else {
					// Load view with erros
					$this->view('users/login', $data); //load view with data
				}	
			} else {
				// Init data 
				$data =[   //all set to nothing because is blank register form
					'email' => '',
					'password' => '',								
					'email_err' => '',
					'password_err' => ''					
				];

				// Load view
				$this->view('users/login', $data); //pass data to load form
			}
		}




	}

