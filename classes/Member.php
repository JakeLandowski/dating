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
    
    public function displayFName()
    { return !empty($this->fname) ? ucfirst(htmlspecialchars($this->fname)) : 'Unspecified'; }

    public function setLName($lname)
    { $this->lname = $lname; }

    public function getLName()
    { return $this->lname; }

    public function displayLName()
    { return !empty($this->lname) ?ucfirst(htmlspecialchars($this->lname)) : 'Unspecified'; }

    public function setAge($age)
    { $this->age = $age; }

    public function getAge()
    { return $this->age; }

    public function displayAge()
    { return !empty($this->age) ? htmlspecialchars($this->age) : 'Unspecified'; }

    public function setGender($gender)
    { $this->gender = $gender; }

    public function getGender()
    { return $this->gender; }

    public function displayGender()
    { return !empty($this->gender) ? ucfirst(htmlspecialchars($this->gender)) : 'Unspecified'; }

    public function setPhone($phone)
    { $this->phone = $phone; }

    public function getPhone()
    { return $this->phone; }

    public function displayPhone()
    { return !empty($this->phone) ? htmlspecialchars($this->fname) : 'Unspecified'; }

    public function setEmail($email)
    { $this->email = $email; }

    public function getEmail()
    { return $this->email; }

    public function displayEmail()
    { return !empty($this->email) ? htmlspecialchars($this->fname) : 'Unspecified'; }

    public function setState($state)
    { $this->state = $state; }

    public function getState()
    { return $this->state; }

    public function displayState()
    { return !empty($this->state) ? ucwords(htmlspecialchars($this->state)) : 'Unspecified'; }

    public function setSeeking($seeking)
    { $this->seeking = $seeking; }

    public function getSeeking()
    { return $this->seeking; }

    public function displaySeeking()
    { return !empty($this->seeking) ? ucfirst(htmlspecialchars($this->seeking)) : 'Unspecified'; }

    public function setBio($bio)
    { $this->bio = $bio; }

    public function getBio()
    { return $this->bio; }

    public function displayBio()
    { return !empty($this->bio) ? ucfirst(htmlspecialchars($this->bio)) : 'Unspecified'; }
}