<?php
/**
 *  Desc...
 * 
 *  @author Jacob Landowski
 * 
 *  CREATE TABLE Member (
 *      member_id int(11)       NOT NULL AUTO_INCREMENT,
 *      fname     varchar(30)   NOT NULL DEFAULT '',
 *      lname     varchar(30)   NOT NULL DEFAULT '',
 *      age       tinyint(4)    NOT NULL DEFAULT '0',
 *      gender    enum('M','F') NOT NULL,
 *      phone     char(14)      NOT NULL DEFAULT '',
 *      email     varchar(20)   NOT NULL DEFAULT '',
 *      state     char(2)       NOT NULL DEFAULT '',
 *      seeking   enum('M','F') NOT NULL,
 *      bio       text,
 *      premium   tinyint(4)    NOT NULL DEFAULT '0',
 *      image     varchar(50)   NOT NULL DEFAULT '',
 *      interests varchar(100)  NOT NULL DEFAULT '',
 *      PRIMARY KEY (member_id)
 *  )     
 *      ENGINE=InnoDB DEFAULT CHARSET=latin1;
 */

require_once getenv('HOME') . '/db_configs/dating_config.php';

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
            if(array_key_exists($key, $this->data)) 
                $this->data[$key] = $value;
        }
    }

    public function setValue($key, $value)
    {
        if(array_key_exists($key, $this->data))
        {
            $this->data[$key] = $value;
            return true;
        }

        return false;
    }

    public function getValue($key)
    {
        if(array_key_exists($key, $this->data))
            return $this->data[$key];
        
        return '';
    }

    public function displayValue($key, $ucfirst=false, $emptyValue=true)
    {
        if($emptyValue && empty($this->getValue($key))) return 'N/A';
        else if($ucfirst) return ucfirst(htmlspecialchars($this->getValue($key)));
        else    return htmlspecialchars($this->getValue($key)); 
    }


    protected static function connect()
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

    protected static function disconnect(&$connection)
    {
        unset($connection);
    }    
}