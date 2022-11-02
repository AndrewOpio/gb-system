<?php
   require_once "db_connection.php";

   class Arrival
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting arrivals
    public function getArrivals()
    {
        $sql = 'SELECT * FROM arrivals';
        $result = pg_query($sql);
        return $result;
    }


    //adding arrivals
    public function addArrival($v_id, $pnumber, $from, $to, $fnumber, $reason, $adate)
    {
        $sql = 'INSERT INTO arrivals (visitorid, passportnumber, arrivingFrom, finaldestination, flightno, travelreason, arrivaldate)
        VALUES ($1, $2, $3, $4, $5, $6, $7)';

        $result = pg_prepare($this->db->dbconn, "add", $sql);
        $result = pg_execute($this->db->dbconn, "add", array($v_id, $pnumber, $from, $to, $fnumber, $reason, $adate));
        return $result;
    }
    
}

























































































































