<?php
	class Posts extends Controller {
	public function __construct(){
		//check user session if user logged in, if not redirect //when use controller
		//if(!isset($_SESSION['user_id'])){ //if we not logged in /when use controller
		if(!isLoggedIn()){
			redirect('users/login');
		}

		$this->postModel = $this->model('Post'); //Load post model
	}

		public function index(){
			// Get post
			$posts = $this->postModel->getPosts(); //grab a post for as

			$data = [
				'posts' => $posts
			];

			$this->view('posts/index', $data);
		}

		public function add(){
			$data = [
				'title' => '',
				'body' => ''
			];

			$this->view('posts/add', $data);



		}
	}