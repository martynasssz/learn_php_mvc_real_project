<?php
	/*
	 * base Controller
	 * Load the models and views
	 */
	class Controller {
			// Load model
		public function model ($model){
			// Require model file from the model folder
			require_once '../app/models/'. $model. '.php';

			//Instatiate model
			return new $model(); //alows load model from 
		}

			//Load view
		public function view($view, $data =[]){ //pass an array dinamic value //pass data in
			//Check for view file
			if(file_exists('../app/views/' .$view .'.php')){ //tikrinam ar toks failas yra
				require_once '../app/views/' .$view .'.php'; //jei yra uzkraunam
			} else {
			//View does not exist
			 die('View does not exist');
			}
		}
	}