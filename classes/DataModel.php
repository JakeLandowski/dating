<?php
/**
 *  Class for managing PDO connections to the Database
 *  also for handling the whitelisted setting and retrieval 
 *  of data from this class when inherited by other classes. 
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
 *      email     varchar(40)   NOT NULL DEFAULT '',
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
 *  Class for managing PDO connections to the Database
 *  also for handling the whitelisted setting and retrieval 
 *  of data from this class when inherited by other classes.
 */
abstract class DataModel
{    
    protected $data = [];

    /**
     *  Initializes the object by adding all of the fields
     *  in given data to internal data by checking the keys
     *  and whitelisting them.
     * 
     *  @param $data The array of data to add to this object
     */
    public function __construct(&$data)
    {
        foreach($data as $key => $value)
        {
            $this->setValue($key, $value);
        }
    }

    /** ~~ PART 4 VALIDATION REQUIREMENT ~~ 
     *  Truncates fname, lfname, email and bio from the form
     *  to ensure they're not too large. 
     * 
     *  Assigns the key and value to the internal data if the key exists
     *  already.
     *  
     *  @param $key   The key to the data, usually the table column name
     *  @param $value The value associated with the key
     */
    public function setValue($key, $value)
    {
        if(array_key_exists($key, $this->data))
        {
            if($key == 'age')
            {
                if($value <= 0) $value = 18;
                $value = (int) $value;
            }
            else if($key == 'fname' || $key == 'lname')
            {
                $value = substr($value, 0, 30);
            }
            else if($key == 'email')
            {
                $value = substr($value, 0, 40);
            }
            else if($key == 'bio')
            {
                $value = substr($value, 0, 255);
            }

            $this->data[$key] = $value;
        }

        return false;
    }

    /**
     *  Retrieves the raw data stored internally from the key index.
     *  
     *  @param $key   The key to the data, usually the table column name
     *  @return mixed The data to return from the internal data
     */
    public function getValue($key)
    {
        if(array_key_exists($key, $this->data))
            return $this->data[$key];
        
        return '';
    }

    /**
     *  Retrieves the escaped data stored internally from the key index.
     *  
     *  @param $key        The key to the data, usually the table column name
     *  @param $ucfirst    Optional boolean that determines if you want the 
     *                     returned data to have the first character uppercased 
     *                     for displaying, false by default
     *  @param $emptyValue Optional boolean that determines if you want the string
     *                     "N/A" to be returned if the data ended up being empty. 
     *  @return mixed      The data to return from the internal data
     */
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