<?php
	class Pages extends Controller { //defautinis controleris
		public function __construct(){				
		}

		public function index(){ 			
			$data = [
				'title' => 'Shareposts',
				'description' =>'Siple social network built on the MVC framework'				
			];

			$this->view('pages/index', $data); //masyva iskelem atskirai, padavem tik kitamaji

		}

		public function about(){ //id uzkomentuojamas
			//echo $id;
			$data = [
				'title' => 'About us',
				'description' =>'App to shere postt for other users'
			];
			
			$this->view('pages/about', $data); //http://localhost/oop/mvc/pages/about gausime ABOUT
		}
	}

	
