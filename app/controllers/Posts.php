<?php
	class Posts extends Controller {
	public function __contruct(){
		//check user session if user logged in, if not redirect //when use controller
		//if(!isset($_SESSION['user_id'])){ //if we not logged in /when use controller
		if(!isLoggedIn()){
			redirect('users/login');
		}
	}

		public function index(){
			$data = [];
			$this->view('posts/index', $data);

		}
	}