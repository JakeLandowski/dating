<?php
/**
 *  Desc...
 * 
 *  @author Jacob Landowski
 */

require_once "{$_SERVER['HOME']}/db_configs/dating_config.php";

 /**
 *  Desc...
 */
abstract class DataModel
{    
    protected $data = [];

    /**
     *  Desc...
     */
    public function __construct(&$data)
    {
        foreach($data as $key => $value)
        {
            if(array_key_exists($key, $this->$data)) 
                $this->data[$key] = $value;
        }
    }

    public function getValue(&$key)
    {
        if(array_key_exists($key, $this->data))
            return $this->data[$key];
    }

    public function getValueEncoded(&$key)
    {
        return htmlspecialchars($this->getValue($key));
    }

    protected function connect()
    {
        try
        {
            $connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $connection->setAttribute(PDO::ATTR_PERSISTENT, true);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $err)
        {
            die("Connection failed: " . $err->getMessage());
        }

        return $connection;
    }

    protected function disconnect(&$connection)
    {
        unset($connection);
    }    
}