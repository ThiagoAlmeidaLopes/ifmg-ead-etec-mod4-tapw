<?php

	require 'config.database.php';

	class DAO {

		private $pdo = null;

		public function __construct() {
       		
			global $HOSTNAME, $DATABASE, $USERNAME, $PASSWORD, $PORT, $CHARSET;

			$DSN = 'mysql:host=' .$HOSTNAME. ';port=' .$PORT. ';dbname=' .$DATABASE;

			$this->pdo = new PDO($DSN, $USERNAME, $PASSWORD);
	   	}

 		public function __destruct() {
 			$this->pdo = null;
 		}

 		public function query ($sql, $params) {

			$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			
			if ($params != null) {
				$sth->execute($params);
			} else {
				$sth->execute();
			}

			$result = $sth->fetchAll();
			
			$sth = null;

			return $result;
 		}
	}

?>