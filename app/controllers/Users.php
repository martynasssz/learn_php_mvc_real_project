<?php
	class Users extends Controller {
		public function __construct(){

		}
		//   this method handle two things: loading our form and post
		//   we need to check to see is it post request, is form beeing submited ir we just loading it
		public function register(){  
				// Check for post
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Process form	
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
	}