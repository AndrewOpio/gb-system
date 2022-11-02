<?php
   require_once "db_connection.php";

   class Point
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting borderpoints
    public function getPoints()
    {
        $sql = 'SELECT * FROM borderpoints';
        $result = pg_query($sql);
        return $result;
    }


    //getting point
    public function getPoint($id)
    {
        $sql ="SELECT * FROM borderpoints WHERE id = ($1)";

        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("get_pnt"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "get_pnt", $sql);
        }
        
        $result = pg_execute($this->db->dbconn, "get_pnt", array($id));
        return $result;
    }    


    //checking if details already exist.
    public function checkDetails($name, $code)
    {
        $sql ="SELECT * FROM borderpoints WHERE pointname = $1 OR pointcode = $2";

        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("check_pnt"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "check_pnt", $sql);
        }
        $result = pg_execute($this->db->dbconn, "check_pnt", array($name, $code));
        return $result;
    }


    //checking if details already exist.
    public function checkEditDetails($name, $code)
    {
        if ($name) {
            $sql ="SELECT * FROM borderpoints WHERE pointname = $1";

        } else {
            $sql ="SELECT * FROM borderpoints WHERE pointcode = $1";
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



    
    //adding borderpoints
    public function addPoint($type, $cdate, $sname, $oname, $bdate, $blocation, $nationality, $citizen, $iaddress, $tprint, $pic, $sign, $pnumber, $idate, $edate)
    {
        $sql = 'INSERT INTO visas (passportType, captureDate, surName, otherNames, dob, birthLocation, nationality, citizen, issueAddress, thumbPrint,  photo, signature, passportNumber, passportIssueDate, passportExpiry)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11 ,$12, $13, $14, $15)';

        $result = pg_prepare($this->db->dbconn, "add", $sql);
        $result = pg_execute($this->db->dbconn, "add", array($type, $cdate, $sname, $oname, $bdate, $blocation, $nationality, $citizen, $iaddress, $tprint, $pic, $sign, $pnumber, $idate, $edate));
        return $result;
    }


    //edit borderpoints
    public function editPoint($name, $code, $lat, $lng, $id)
    {
        $sql = 'UPDATE borderpoints SET pointname = $1, pointcode = $2, lat = $3, lng = $4 WHERE id = $5';

        $result = pg_prepare($this->db->dbconn, "edit_point", $sql);
        $result = pg_execute($this->db->dbconn, "edit_point", array($name, $code, $lat, $lng, $id));
        return $result;
    }    
    
    
    //delete borderpoints
    public function deletePoint($id)
    {
        $sql = 'DELETE FROM borderpoints WHERE id = $1';

        $result = pg_prepare($this->db->dbconn, "delete_point", $sql);
        $result = pg_execute($this->db->dbconn, "delete_point", array($id));
        return $result;
    }    
}


























































































































