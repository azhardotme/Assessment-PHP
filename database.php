<?php

class Database
{
    public $connect;
    public  function __construct()
    {

        $dbc = $this->connect = mysqli_connect("localhost", "root", "", "students");
        $sql = "CREATE TABLE IF NOT EXISTS students_info(id INT NOT NULL AUTO_INCREMENT,
                                                name VARCHAR(64),
                                                image VARCHAR(64),
                                                PRIMARY KEY(id)
                                                )";
        $result = mysqli_query($dbc, $sql) or die("Database Connection Failed:$sql");
    }

    public function insert($inserted)
    {
        $result = $this->connect->query($inserted) or die($this->connect->error . __LINE__);
        if ($result) {
            header("Location: index.php?msg=" . urlencode('Data insert successfull'));
        } else {
            die("Error:(" . $this->connect->error . ")" . $this->connect->error);
        }
    }


    public function select($selected)
    {
        $result = $this->connect->query($selected) or die($this->connect->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function edit($edited)
    {
        $result = $this->connect->query($edited) or die($this->connect->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function update($post)
    {
        $result = $this->connect->query($post) or die($this->connect->error . __LINE__);
        if ($result) {
            header("Location: index.php?msg=" . urlencode('Data update successfull'));
        } else {
            die("Error:(" . $this->connect->error . ")" . $this->connect->error);
        }
    }
    public function delete($del)
    {
        $result = $this->connect->query($del) or die($this->connect->error . __LINE__);
        if ($result) {
            header("Location: index.php?msg=" . urlencode('Data delete successfull'));
        } else {
            die("Error:(" . $this->connect->error . ")" . $this->connect->error);
        }
    }
}
