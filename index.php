<?php

class Database
{
    // specify your own database credentials
    private $host = "127.0.0.1";
    private $db_name = "nbaiot";
    private $username = "root";
    private $password = "1234";
    private $results;
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    // get the database connection
    public function getConnection()
    {
        return $this->conn;
    }

    private function exec($query)
    {
        try {
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function all($table_name)
    {
        return $this->exec("SELECT * FROM {$table_name}");
    }
}

class Model
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function all($fields)
    {
//        var_dump($fields);
//        die();
        return $this->db->all(property_exists($this, 'table') ? $this->table : strtolower(get_class($this)));
    }
}

class Device extends Model
{
    protected $table = 'device';
}


class BenignTraffic extends Model
{
    protected $table = 'benign_traffic';


}

class Attack extends Model
{
    protected $table = 'attack';
}

class Route
{
    public static $routes = [];

    public static function get($url, $callback)
    {
        if ($url && is_callable($callback)) {
            self::$routes['get'][$url] = $callback;
        }
    }

    public static function post($url, $callback)
    {
        if ($url && is_callable($callback)) {
            self::$routes['post'][$url] = $callback;
        }
    }

    public static function check()
    {
        if (!$_GET['path'] || $_POST['path']) $_GET['path'] = '/';

        foreach (self::$routes['get'] as $key => $value) {
            if ($_GET['path'] && $key === $_GET['path']) {
                //self::$routes['get'][$_GET['path']](123)
                $params = array_filter($_GET, function ($value, $key) {
                    return $key !== 'path';
                }, ARRAY_FILTER_USE_BOTH);

                return $value($params);
            }
        }

        foreach (self::$routes['post'] as $key => $value) {
            if ($_POST['path'] && $key === $_POST['path']) {
                return self::$routes['post'][$_POST['path']]();
            }
        }

        if ($_GET['path'] || $_POST['path']) {
            die("Route not found");
        }
    }
}

//var_dump($device->all());

Route::get('devices', function ($request) {
    echo json_encode(
        (new Device())->all($request)
    );
});

Route::get('benign_traffic', function ($request) {
    echo json_encode(
        (new BenignTraffic())->all($request)
    );
});

Route::get('attack', function ($request) {
    echo json_encode(
        (new Attack())->all($request)
    );
});

Route::get('request', function () {
    var_dump($_REQUEST, $_SERVER);
});

Route::get('/', function () {
    require_once 'front.php';
});

Route::check();

die();
?>