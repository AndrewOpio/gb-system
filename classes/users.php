<?php
   require_once "db_connection.php";

   class User
   {
    public $db;

    public function __construct()
    {
       $this->db = new Connection();
    }


    //getting users
    public function getUsers()
    {
        $sql = 'SELECT * FROM users';
        $result = pg_query($sql);
        return $result;
    }


    //getting user
    public function getUser($id)
    {
        $sql ="SELECT * FROM users WHERE id = ($1)";

        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("get_user"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "get_user", $sql);
        }
        
        $result = pg_execute($this->db->dbconn, "get_user", array($id));
        return $result;
    }    

    
    //checking if username already exist.
    public function checkDetails($email, $name)
    {
        $sql ="SELECT * FROM  users WHERE username = $2  OR email = $1";

        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("check_user"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "check_user", $sql);
        }
        $result = pg_execute($this->db->dbconn, "check_user", array($email, $name));
        return $result;
    }
    

    //checking if details already exist.
    public function checkEditDetails($email, $name)
    {
        if ($name) {
            $sql ="SELECT * FROM users WHERE username = $1";

        } else {
            $sql ="SELECT * FROM users WHERE email = $1";
        }
        
        $stmt = pg_query_params($this->db->dbconn, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array("check_user1"));
        if (pg_num_rows($stmt) == 0) {
            $result = pg_prepare($this->db->dbconn, "check_user1", $sql);
        }

        if ($name) {
            $result = pg_execute($this->db->dbconn, "check_user1", array($name));
        } else {
            $result = pg_execute($this->db->dbconn, "check_user1", array($email));
        }

        return $result;
    }
    

    //adding user
    public function addUser($email, $name, $username, $bio, $password, $pic)
    {
        $sql = 'INSERT INTO users (email, name, username, bio, password, image, status) VALUES ($1, $2, $3, $4, $5, $6, $7)';

        $result = pg_prepare($this->db->dbconn, "add_user", $sql);
        $result = pg_execute($this->db->dbconn, "add_user", array($email, $name, $username, $bio, $password, $pic, "active"));
        return $result;
    }    
    

    //edit user
    public function editUser($id, $email, $name, $username, $bio, $password, $pic)
    {

        if ($password && $pic) {

            echo $pic;
            echo $pic;
            echo $pic;
            echo $pic;

            $sql = 'UPDATE users SET email = $2, name = $3, username = $4,  bio = $5, password = $6, image = $7 WHERE id = $1';
            $result = pg_prepare($this->db->dbconn, "edit_user", $sql);
            $result = pg_execute($this->db->dbconn, "edit_user", array($id, $email, $name, $username, $bio, $password, $pic));
    
        } elseif ($password) {
            $sql = 'UPDATE users SET email = $2, name = $3, username = $4,  bio = $5, password = $6 WHERE id = $1';
            $result = pg_prepare($this->db->dbconn, "edit_user", $sql);
            $result = pg_execute($this->db->dbconn, "edit_user", array($id, $email, $name, $username, $bio, $password));
    
        } elseif ($pic) {
            $sql = 'UPDATE users SET email = $2, name = $3, username = $4,  bio = $5, image = $6 WHERE id = $1';
            $result = pg_prepare($this->db->dbconn, "edit_user", $sql);
            $result = pg_execute($this->db->dbconn, "edit_user", array($id, $email, $name, $username, $bio, $pic));    
        
        } else {
            $sql = 'UPDATE users SET email = $2, name = $3, username = $4,  bio = $5 WHERE id = $1';
            $result = pg_prepare($this->db->dbconn, "edit_user", $sql);
            $result = pg_execute($this->db->dbconn, "edit_user", array($id, $email, $name, $username, $bio));    
        }         

        return $result;
    }    
 
    
    //delete user
    public function deleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE id = $1';

        $result = pg_prepare($this->db->dbconn, "delete_user", $sql);
        $result = pg_execute($this->db->dbconn, "delete_user", array($id));
        return $result;
    }    

    
    //user status
    public function userStatus($id, $status)
    {
        $sql = 'UPDATE users SET status = $2 WHERE id = $1';

        $result = pg_prepare($this->db->dbconn, "user_status", $sql);
        $result = pg_execute($this->db->dbconn, "user_status", array($id, $status));
        return $result;
    }        
    
}


























































































































