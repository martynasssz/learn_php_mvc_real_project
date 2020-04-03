<?php
	/*
	 * App Core Class
	 * Creates URL $ loads core controller
	 * URL FORMAT - /controller/method/params
	 *
	 */

	class Core {
		protected $currentController = 'Pages'; //jei i url irasysime mvc/ ukraus pages controlery
		protected $currentMethod = 'index';
		protected $params = []; //prilyginam tusciam masyvui pagal nutylejima

		public function __construct(){
			//print_r($this->getUrl()); //ivykdysim funkcija kai sukursime nauja objekta //index.php faile

			$url = $this->getUrl();

			// Look in controller for first value

			if(file_exists('../app/controllers/'. ucwords($url[0]).'.php')){ //tikrina ar pirma egzituoja toks controleris, gaunamas is url kaip pirmas masyvo elementas //unwords pavers kiekvieno zodzio pirmaja raide i didziaja
				// If exists, set as controller
				$this->currentController = ucwords($url[0]) ; //jei post egzistuota controller folderyje, tuomet parametras $currentController perrasome Pages, priskirant controleri
				//Unset 0 Index
				unset($url[0]);
			}

			// Require the controller
			require_once '../app/controllers/'.$this->currentController.'.php';

			//Instantiate controller class
			$this->currentController = new $this->currentController; //tam, kad uzkrautu sukurtus kontrolerius. Poo defaultu kraus Pages controlleri

			// Check for second part of url
			if(isset($url[1])){
				// Check to see if meyhod exists in controller
				if(method_exists($this->currentController, $url[1])){ //jei metodas egzistuoja
					$this->currentMethod = $url[1]; //parametrui priskiriame metoda
					// Unset 1 index
					unset($url[1]);//unsetinam metoda, kad galetu uzkrauti parametra
				}
			}

			//echo $this->currentMethod;//uzkrovus puslapi http://localhost/oop/mvc/ matome index (pardomas defaultnis metodas) jei http://localhost/oop/mvc/pages/about (jei nebus metodo about uzkraus index),jei bus metodas about tada ji ir uzkraus

			//Get params //get any value throughthe paramether
			$this->params = $url ? array_values($url) : []; //jei yra masyvo grazina masyvo vertes jei ne priskiria tucia masyva //array_values() FunctionReturn all the values of an array (not the keys)

			//Call a callback with array of params
			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);//pirmiausia iskviecia masyve esancias funkcijas (metodus), po to prideda parametra
				

		}

		public function getUrl(){//echo $_GET['url']; gauname infor is url uz klaustuko
			if(isset( $_GET['url'])){ //if(isset( $_GET['url'])) patikrinam ar egzistuoja			
				$url = rtrim($_GET['url'],'/'); //su sia funkcija iskaido gauta url tarp sleshu
				$url = filter_var($url, FILTER_SANITIZE_URL); //filter variable in certain ways, we can filter strings, numbers, check URL format
				$url = explode ('/', $url); //panaudojant sia funkcija viska sudedam i array. Pvz./post/edit/1 viskas eis eiles tvarka nuo post iki 1 zemin
				return $url; //i URL ivede http://localhost/oop/mvc/post/edit/1, gausime mesyva Array ( [0] => post [1] => edit [2] => 1 ) //konstruktriaus pagalba print_r($this->getUrl())
			}
		}	
	}





