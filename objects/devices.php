<?php

class Device
{
    private $conn;
    private $table_name = "device";

    public $id;
    public $device_model;
    public $device_type;
    public $num_instances;
    public $mirai;
    public $bashline;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read()
    {

        // select all query
        $query = "SELECT * FROM device";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}