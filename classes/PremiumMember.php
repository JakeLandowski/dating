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
    public function __construct($data)
    {
        $this->data['premium']   = '';
        $this->data['image']     = '';
        $this->data['interests'] = ''; 
        parent::__construct($data);
    }
}