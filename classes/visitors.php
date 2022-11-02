<?php
   require_once "db_connection.php";

   class Visitor
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting visitors
    public function getVisitors()
    {
        $sql = 'SELECT * FROM gb_visitors';
        $result = pg_query($sql);
        return $result;
    }


    //getting visitor
    public function getVisitor($pnumber)
    {
        $sql = 'SELECT * FROM gb_visitors WHERE passportnumber = ($1)';

        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("vistr"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "vistr", $sql);
        }
        
        $result = pg_execute($this->db->dbconn, "vistr", array($pnumber));
        return $result;
    }
    

    //getting suggestions
    public function getSuggestions($keyword)
    {
        $sql ="SELECT * FROM gb_visitors WHERE passportnumber like '" . $keyword . "%'";
        $result = pg_query($sql);
        return $result;
    }

    
    //adding visitors
    public function addVisitor($type, $cdate, $sname, $oname, $bdate, $blocation, $nationality, $citizen, $iaddress, $tprint, $pic, $sign, $pnumber, $idate, $edate)
    {
        $sql = 'INSERT INTO gb_visitors (passportType, captureDate, surName, otherNames, dob, birthLocation, nationality, citizen, issueAddress, thumbPrint,  photo, signature, passportNumber, passportIssueDate, passportExpiry)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11 ,$12, $13, $14, $15)';

        $result = pg_prepare($this->db->dbconn, "add", $sql);
        $result = pg_execute($this->db->dbconn, "add", array($type, $cdate, $sname, $oname, $bdate, $blocation, $nationality, $citizen, $iaddress, $tprint, $pic, $sign, $pnumber, $idate, $edate));
        return $result;
    }
    
}












































































