<?php
	/*
	 * PDO Database Class
	 * Connect to database
	 * Create prepared statemets
	 * Bind values
	 * Return rows and results
	 */

	class Database {
		private $host = DB_HOST;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $dbname = DB_NAME;

		private $dbh; // DB handler when prepare statement
		private $stmt;
		private $error;

		public function __construct(){
			// Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			

			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  //three modes:silent, warning, exeptions
			);

			// Create PDO instance
			try {
				$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
				//echo 'Connected successfully';
			} catch(PDOExeption $e) {
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}

		// Prepare statement with query
		public function query($sql){
			$this->stmt = $this->dbh->prepare($sql); //kurdami uzklausas desim i prepare
		}

		//bind value
		public function bind($param, $value, $type = null){ //jei nieko nepaduodama bus tipas null
			if(is_null($type)){ //jeigu yra null, run swich()
				switch(true){
					case is_int($value):  //check is something integer
						$type = PDO::PARAM_INT; //set integer
						break;
					case is_bool($value):  //check is something boolem
						$type = PDO::PARAM_BOOL; //set boolem
						break;	
					case is_null($value):  //check is something is null
						$type = PDO::PARAM_NULL; //set null
						break;
					default: //don't suit any case
						$type = PDO::PARAM_STR; //set string								
				}
			}

			//  Run bind value
			$this->stmt->bindValue($param, $value, $type);
		}

			//  Create execute method // Execute the prepate statement
			public function execute(){
				return $this->stmt->execute();
			}

			//  Methods for results getting

			//  Get result set as array of objects
			public function resultSet() {
				$this->execute();
				return $this->stmt->fetchAll(PDO::FETCH_OBJ); //put PDO::FETCH_OBJ because we want get like object, not asociated array
			}

			// Get single record as object			
			public function single(){ //get single row
				$this->execute();
				return $this->stmt->fetch(PDO::FETCH_OBJ); //get single row
			}

			//  Get row count
			public function rowCount(){
				return $this->stmt->rowCount();  //rowCount() is methode, part of PDO
			}

		}
