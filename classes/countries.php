<?php
   require_once "db_connection.php";

   class Country
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting countries
    public function getCountries()
    {
        $sql = 'SELECT * FROM countries';
        $result = pg_query($sql);
        return $result;
    }
    
    //getting country
    public function getCountry($id)
    {
        $sql ="SELECT * FROM countries WHERE id = ($1)";

        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("get_st"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "get_st", $sql);
        }
        
        $result = pg_execute($this->db->dbconn, "get_st", array($id));
        return $result;
    }


    //checking if details already exist.
    public function checkDetails($name, $code)
    {
        $sql ="SELECT * FROM countries WHERE countryname = $1 OR countrycode = $2";

        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("check_state"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "check_state", $sql);
        }
        $result = pg_execute($this->db->dbconn, "check_state", array($name, $code));
        return $result;
    }



    //checking if details already exist.
    public function checkEditDetails($name, $code)
    {
        if ($name) {
            $sql ="SELECT * FROM countries WHERE countryname = $1";

        } else {
            $sql ="SELECT * FROM countries WHERE countrycode = $1";
        }
        
        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("check_estate"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "check_estate", $sql);
        }

        if ($name) {
            $result = pg_execute($this->db->dbconn, "check_estate", array($name));
        } else {
            $result = pg_execute($this->db->dbconn, "check_estate", array($code));
        }

        return $result;
    }
    

    
    //adding country
    public function addCountry($name, $code)
    {
        $sql = 'INSERT INTO countries (countryname, countrycode) VALUES ($1, $2)';

        $result = pg_prepare($this->db->dbconn, "add_country", $sql);
        $result = pg_execute($this->db->dbconn, "add_country", array($name, $code));
        return $result;
    }   
    
    
    //edit country
    public function editCountry($name, $code, $id)
    {
        $sql = 'UPDATE countries SET countryname = $1, countrycode = $2 WHERE id = $3';

        $result = pg_prepare($this->db->dbconn, "edit_country", $sql);
        $result = pg_execute($this->db->dbconn, "edit_country", array($name, $code, $id));
        return $result;
    }    
    
    
    //delete country
    public function deleteCountry($id)
    {
        $sql = 'DELETE FROM countries WHERE id = $1';

        $result = pg_prepare($this->db->dbconn, "delete_country", $sql);
        $result = pg_execute($this->db->dbconn, "delete_country", array($id));
        return $result;
    }        
    
}






































































































































































