<?php
	class Posts extends Controller {
	public function __construct(){
		//check user session if user logged in, if not redirect //when use controller
		//if(!isset($_SESSION['user_id'])){ //if we not logged in /when use controller
		if(!isLoggedIn()){
			redirect('users/login');
		}

		$this->postModel = $this->model('Post'); //Load post model in constructor
		$this->userModel = $this->model('User'); //Load user model in constructor
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
			if($_SERVER['REQUEST_METHOD']=='POST'){

				// Sanitize POST arra
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],  //user_id comes form a session
					'title_err' => '',
					'body_err' =>''
				];

				// Validate title
				if(empty($data['title'])){
					$data['title_err'] = 'Please enter title';
				}

				// Validate body
				if(empty($data['body'])){
					$data['body_err'] = 'Please enter body text';
				}

				// Make sure no errors
				if(empty($data['title_err']) && empty($data['body_err'])){//if those things are true
					// Validated
					if($this->postModel->addPost($data)){
						flash('post_message', 'Post Added');
						redirect('posts');
					} else {
						die('Somethig went wrong');
					}

				} else {
					// Load view with errors
					$this->view('posts/add', $data);
				}
			
			} else {
				$data = [
					'title' => '',
					'body' =>''
				];
			}

			$data = [
				'title' => '',
				'body' => ''
			];

			$this->view('posts/add', $data);
		}

		public function show($id){
			$post = $this->postModel->getPostById($id); //pass id for getPostById() function that is comming from url //data from model ($row) in this variable
			$user = $this->userModel->getUserById($post->user_id); // since we have the post we can access user_id field in the post table
			$data = [    //$post data stick in this variable
				'post' => $post,
				'user' => $user
			];

			$this->view('posts/show', $data);	
		}
	}