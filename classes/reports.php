<?php
   require_once "db_connection.php";

   class Report
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting arrivals between a given date range
    public function getArrivals($start, $end)
    {
        $sql = 'SELECT * FROM arrivals WHERE arrivaldate >= ($1) AND arrivaldate <= ($2)';

        $result = pg_prepare($this->db->dbconn, "get_arr", $sql);
        $result = pg_execute($this->db->dbconn, "get_arr", array($start, $end));
        return $result;
    }


    //getting departures between a given date range 
    public function getDepartures($start, $end)
    {
        $sql = 'SELECT * FROM departures WHERE departuredate >= ($1) AND departuredate <= ($2)';

        $result = pg_prepare($this->db->dbconn, "get_dep", $sql);
        $result = pg_execute($this->db->dbconn, "get_dep", array($start, $end));
        return $result;
    }


    //getting visas between a given date range 
    public function getVisas($start, $end)
    {
        $sql = 'SELECT * FROM Visas WHERE departuredate >= ($1) AND departuredate <= ($2)';

        $result = pg_prepare($this->db->dbconn, "get_visas", $sql);
        $result = pg_execute($this->db->dbconn, "get_visas", array($start, $end));
        return $result;
    }    
    
}






































































































































































