<?php

class DataObject {
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "appgip";

    public function execSql($sql) {  
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $this->sql = $sql;
        
        if($result = mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return $result;
        } else {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            //header("Location: http://localhost/AppGip/?response=error");
        }
    }
}
?>