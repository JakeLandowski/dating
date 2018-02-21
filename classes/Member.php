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
        'picture'   => '',
    ]; 

    public static function getMembers($start, $amount, $order)
    {
        $connection = parent::connect();

        $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM Member' . 
               'ORDER BY :order LIMIT :start, :amount';

        try
        {
            $statement = $connection->prepare($sql);
            $statement->bindValue(':start',  $start,  PDO::PARAM_INT);
            $statement->bindValue(':amount', $amount, PDO::PARAM_INT);
            $statement->bindValue(':order',  $order,  PDO::PARAM_STR);
            $statement->execute();

            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            $members = [];

            foreach($rows as $row)
            {
                $members[] = $row['premium'] === 1 ?
                    new PremiumMember($row) : new Member($row);
            }

            $statement = $connection->query('SELECT found_rows() AS totalRows');
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            parent::disconnect();

            return [$members, $row['totalRows']];
        }
        catch(PDOException $err)
        {
            parent::disconnect();
            die('Query failed: ' . $err->getMessage());
        }
    }

    public static function getMember($id)
    {
        $connection = parent::connect();
        $sql = 'SELECT * FROM Member WHERE id = :id';

        try
        {
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            parent::disconnect();

            if(!$row) return null;
            
            return $row['premium'] === 1 ?
                new PremiumMember($row) : new Member($row); 
        }
        catch(PDOException $err)
        {
            parent::disconnect();
            die('Query failed: ' . $err->getMessage());
        }
    }
}