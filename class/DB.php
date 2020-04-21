<?php
/**
 * Class: Database (DB)
 * This is for Connet to DB and run query
 */

 class DB {

   private $conn;

   //Create a connection to DB
   public function __construct() {
     $this->conn = new mysqli("localhost", "root", "", "tastepad");
     if ($this->conn->connect_error) {
         die('Connect Error: ' . $conn->connect_error);
     }
   }

   //Get result from running Query in DB
   public function query($sql) {
     $result = $this->conn->query($sql);
     return $result;
   }
   public function __destruct() {
	  $this->conn->close();
    }

 }

?>
