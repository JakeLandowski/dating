<?php
/**
 *  Class for premium members, extends from normal member class
 *  and adds the data for interests page.
 * 
 *  @author Jacob Landowski
 */

 /**
 *  Class for premium members, extends from normal member class
 *  and adds the data for interests page.
 */
class PremiumMember extends Member
{
    /**
     *  Initializes a Premium Member object by adding 2 more whitelisted
     *  fields in the data array, and then calls the Member constructor.
     * 
     *  @param $data The array of data to initialize with, will be checked
     *               against whitelisted keys in the internal data array 
     */
    public function __construct($data)
    {
        $this->data['image']     = '';
        $this->data['interests'] = ''; 
        parent::__construct($data);
    }
}