<?php
   require_once "db_connection.php";

   class Departure
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting arrivals
    public function getDepartures()
    {
        $sql = 'SELECT * FROM arrivals';
        $result = pg_query($sql);
        return $result;
    }


    //adding arrivals
    public function addDeparture($v_id, $pnumber, $to, $fnumber, $reason, $ddate)
    {
        $sql = 'INSERT INTO departures (visitorid, passportnumber, finaldestination, flightno, departurereason, departuredate)
        VALUES ($1, $2, $3, $4, $5, $6)';

        $result = pg_prepare($this->db->dbconn, "add_dep", $sql);
        $result = pg_execute($this->db->dbconn, "add_dep", array($v_id, $pnumber, $to, $fnumber, $reason, $ddate));
        return $result;
    }
    
}

























































































































