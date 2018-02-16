<?php

class PremiumMember extends Member
{
    private $inDoorInterests, $outDoorInterests;

    public function __construct($fname='', $lname='', $age='', $gender='', $phone='')
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    public function setInDoorInterests($inDoorInterests)
    { $this->inDoorInterests = $inDoorInterests; }

    public function getInDoorInterests()
    { return $this->inDoorInterests; }

    public function setOutDoorInterests($outDoorInterests)
    { $this->outDoorInterests = $outDoorInterests; }

    public function getOutDoorInterests()
    { return $this->outDoorInterests; }
}