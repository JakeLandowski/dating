<?php

class Member
{
    protected $fname, $lname, $age, 
              $gender, $phone, $email, 
              $state, $seeking, $bio;
    
    public function __construct($fname='', $lname='', $age='', $gender='', $phone='')
    {
        $this->setFName($fname);
        $this->setLName($lname);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setPhone($phone);
    }

    public function setFName($fname)
    { $this->fname = $fname; }

    public function getFName()
    { return $this->fname; }

    public function setLName($lname)
    { $this->lname = $lname; }

    public function getLName()
    { return $this->lname; }

    public function setAge($age)
    { $this->age = $age; }

    public function getAge()
    { return $this->age; }

    public function setGender($gender)
    { $this->gender = $gender; }

    public function getGender()
    { return $this->gender; }

    public function setPhone($phone)
    { $this->phone = $phone; }

    public function getPhone()
    { return $this->phone; }

    public function setEmail($email)
    { $this->email = $email; }

    public function getEmail()
    { return $this->email; }

    public function setState($state)
    { $this->state = $state; }

    public function getState()
    { return $this->state; }

    public function setSeeking($seeking)
    { $this->seeking = $seeking; }

    public function getSeeking()
    { return $this->seeking; }

    public function setBio($bio)
    { $this->bio = $bio; }

    public function getBio()
    { return $this->bio; }

}