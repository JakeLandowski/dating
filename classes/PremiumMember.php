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
    private $_inDoorInterests, $_outDoorInterests;

    public function __construct($fname='', $lname='', $age='', $gender='', $phone='')
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
        $this->_inDoorInterests  = [];
        $this->_outDoorInterests = [];
    }

    /**
     *  Sets the array of chosen indoor interests.
     * 
     *  @param Array $inDoorInterests      The array of indoor interests
     */
    public function setInDoorInterests($inDoorInterests)
    { $this->_inDoorInterests = $inDoorInterests; }

    /**
     *  Gets the array of chosen indoor interests.
     * 
     *  @return Array      The array of indoor interests
     */
    public function getInDoorInterests()
    { return $this->_inDoorInterests; }

    /**
     *  Sets the array of chosen outdoor interests.
     * 
     *  @param Array $outDoorInterests      The array of outdoor interests
     */
    public function setOutDoorInterests($outDoorInterests)
    { $this->_outDoorInterests = $outDoorInterests; }

    /**
     *  Gets the array of chosen outdoor interests.
     * 
     *  @return Array      The array of outdoor interests
     */
    public function getOutDoorInterests()
    { return $this->_outDoorInterests; }
}