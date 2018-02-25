<?php
/**
 *  Class to represent the core member data.
 * 
 *  @author Jacob Landowski
 */

 /**
 *  Class to represent the core member data.
 */
class Member extends DataModel
{
    protected $data = 
    [
        'member_id' => '',
        'fname'     => '',
        'lname'     => '',
        'age'       => '',
        'gender'    => '',
        'phone'     => '',
        'email'     => '',
        'state'     => '',
        'seeking'   => '',
        'bio'       => '',
        'premium'   => '',
    ];
    
    static protected $validColumns = 
    [
        'member_id', 'fname', 'lname',
        'age', 'gender', 'phone',
        'email', 'state', 'seeking',
        'bio', 'premium', 'interests'
    ];

    public static function getMembers($start, $amount, $order)
    {
        $connection = parent::connect();

            //  If order given is a valid column use it
        $sql = in_array($order, Member::$validColumns) ? 
                "SELECT SQL_CALC_FOUND_ROWS * FROM Member 
                 ORDER BY $order LIMIT :start, :amount" :
                'SELECT SQL_CALC_FOUND_ROWS * FROM Member LIMIT :start, :amount';
        try
        {
            $statement = $connection->prepare($sql);
            $statement->bindValue(':start',  $start,  PDO::PARAM_INT);
            $statement->bindValue(':amount', $amount, PDO::PARAM_INT);
            $statement->execute();

            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            $members = [];

            foreach($rows as $row)
            {
                $members[] = $row['premium'] == 1 ?
                    new PremiumMember($row) : new Member($row);
            }

            $statement = $connection->query('SELECT found_rows() AS totalRows');
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            parent::disconnect($connection);

            return ['members' => $members, 'totalRows' =>$row['totalRows']];
        }
        catch(PDOException $err)
        {
            parent::disconnect($connection);
            die('Query failed: ' . $err->getMessage());
        }
    }

    public static function getMember($id)
    {
        $connection = parent::connect();
        $sql = 'SELECT * FROM Member WHERE member_id = :member_id';

        try
        {
            $statement = $connection->prepare($sql);
            $statement->bindValue(':member_id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            parent::disconnect($connection);

            if(!$row) return null;
            
            return $row['premium'] == 1 ?
                new PremiumMember($row) : new Member($row); 
        }
        catch(PDOException $err)
        {
            parent::disconnect($connection);
            die('Query failed: ' . $err->getMessage());
        }
    }

    public function registerMember()
    {
        $connection = parent::connect();
        $sql = 'SELECT email FROM Member WHERE email = :email';

        try
        {
            $statement = $connection->prepare($sql);
            $statement->bindValue(':email', $this->getValue('email'), PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            
            if(!$row) return $this->insertMember($connection);
        }
        catch(PDOException $err)
        {
            parent::disconnect($connection);
            die('Query failed: ' . $err->getMessage());
        }
    }

    protected function insertMember($connection)
    {
        $sql = 'INSERT INTO Member
                (
                    fname, lname, age, gender, 
                    phone, email, state, seeking,
                    bio, premium, image, interests
                ) 
                VALUES
                (
                    :fname, :lname, :age, :gender, 
                    :phone, :email, :state, :seeking, 
                    :bio, :premium, :image, :interests
                )';
        try
        {
            $premium   = $this->getValue('premium');
            $image     = $premium == 1 ? $this->getValue('image')     : '';
            $interests = $premium == 1 ? $this->getValue('interests') : ''; 

            $statement = $connection->prepare($sql);
            $statement->bindValue(':fname',   $this->getValue('fname'),   PDO::PARAM_STR);
            $statement->bindValue(':lname',   $this->getValue('lname'),   PDO::PARAM_STR);
            $statement->bindValue(':age',     $this->getValue('age'),     PDO::PARAM_INT);
            $statement->bindValue(':gender',  $this->getValue('gender'),  PDO::PARAM_STR);
            $statement->bindValue(':phone',   $this->getValue('phone'),   PDO::PARAM_STR);
            $statement->bindValue(':email',   $this->getValue('email'),   PDO::PARAM_STR);
            $statement->bindValue(':state',   $this->getValue('state'),   PDO::PARAM_STR);
            $statement->bindValue(':seeking', $this->getValue('seeking'), PDO::PARAM_STR);
            $statement->bindValue(':bio',     $this->getValue('bio'),     PDO::PARAM_STR);
            
            $statement->bindValue(':premium',   $premium,   PDO::PARAM_INT);
            $statement->bindValue(':image',     $image,     PDO::PARAM_STR);
            $statement->bindValue(':interests', $interests, PDO::PARAM_STR);
            
            $statement->execute();
            
            $id = $connection->lastInsertId();

            parent::disconnect($connection);

            if($id) return true;
            else    return false;
        }
        catch(PDOException $err)
        {
            parent::disconnect($connection);
            die('Query failed: ' . $err->getMessage());
        }
    }
}