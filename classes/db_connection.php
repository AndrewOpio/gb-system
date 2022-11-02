<?php
//lo"(
   class Connection
   {
       public $dbconn;
       
       public function __construct()
       {
            $host = "localhost";
            $user = "postgres";
            $port = 5432;
            $password = "postgres";
            $dbname = "postgres";
            
            $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";

            $this->dbconn = pg_connect($connection_string);
         }
   }