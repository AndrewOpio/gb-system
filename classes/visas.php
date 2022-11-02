<?php
   require_once "db_connection.php";

   class Visa
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting visas
    public function getVisas()
    {
        $sql = 'SELECT * FROM visas';
        $result = pg_query($sql);
        return $result;
    }

    //getting visa
    public function getVisa($id)
    {
        $sql = 'SELECT * FROM visas WHERE visanumber = $1';
        $result = pg_prepare($this->db->dbconn, "get_visa", $sql);
        $result = pg_execute($this->db->dbconn, "get_visa", array($id));
        return $result;
    }    
    
    
    //adding visas
    public function addVisa($number, $pnumber, $adate, $duration, $point, $edate, $by, $fees)
    {
        $sql = 'INSERT INTO visas (visaNumber, passportNumber, arrivalDate, visaDuration, expiryDate, issuedBy, placeOfIssue, feesPaid)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8)';

        $result = pg_prepare($this->db->dbconn, "add_visa", $sql);
        $result = pg_execute($this->db->dbconn, "add_visa", array($number, $pnumber, $adate, $duration, $edate, $by, $point, $fees));
        return $result;
    }


    //adding visas
    public function approveVisa($id, $by)
    {
        $sql = 'UPDATE visas SET approvedby = ($2)  WHERE id =  ($1)';

        $result = pg_prepare($this->db->dbconn, "app_visa", $sql);
        $result = pg_execute($this->db->dbconn, "app_visa", array($id, $by));
        return $result;
    }    
    
}


























































































































