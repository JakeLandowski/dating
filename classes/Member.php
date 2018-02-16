<?php
/**
 *  Class to represent the core member data.
 * 
 *  @author Jacob Landowski
 */

 /**
 *  Class to represent the core member data.
 */
class Member
{
    protected $fname, $lname, $age, 
              $gender, $phone, $email, 
              $state, $seeking, $bio;
    
    /**
     *  Contructor that sets the first name, last name, age, gender, and phone
     * 
     *  @param String $fname     The first name
     *  @param String $lname     The last name
     *  @param number $age       The age
     *  @param String $gender    The gender
     *  @param number $phone     The phone number
     */
    public function __construct($fname='', $lname='', $age='', $gender='', $phone='')
    {
        $this->setFName($fname);
        $this->setLName($lname);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setPhone($phone);
    }

    /**
     *  Sets the first name.
     * 
     *  @param String $fname     The first name
     */
    public function setFName($fname)
    { $this->fname = $fname; }

    /**
     *  Gets the first name.
     * 
     *  @return String      The first name
     */
    public function getFName()
    { return $this->fname; }
    
    /**
     *  Gets the first name escaped and capitalized.
     * 
     *  @return String      The escaped, capitalized first name
     */
    public function displayFName()
    { return !empty($this->fname) ? ucfirst(htmlspecialchars($this->fname)) : 'Unspecified'; }

    /**
     *  Sets the last name.
     * 
     *  @param String $lname     The last name
     */
    public function setLName($lname)
    { $this->lname = $lname; }

    /**
     *  Gets the last name.
     * 
     *  @return String      The last name
     */
    public function getLName()
    { return $this->lname; }

    
    /**
     *  Gets the last name escaped and capitalized.
     * 
     *  @return String      The last name
     */
    public function displayLName()
    { return !empty($this->lname) ?ucfirst(htmlspecialchars($this->lname)) : 'Unspecified'; }

    /**
     *  Sets the age.
     * 
     *  @param number $age     The age
     */
    public function setAge($age)
    { $this->age = $age; }

    /**
     *  Gets the age.
     * 
     *  @return number      The age
     */
    public function getAge()
    { return $this->age; }

    /**
     *  Gets the age, escaped.
     * 
     *  @return number      The escaped age
     */
    public function displayAge()
    { return !empty($this->age) ? htmlspecialchars($this->age) : 'Unspecified'; }

    /**
     *  Sets the gender.
     * 
     *  @param String $gender     The gender
     */
    public function setGender($gender)
    { $this->gender = $gender; }

    /**
     *  Gets the gender.
     * 
     *  @return String      The gender
     */
    public function getGender()
    { return $this->gender; }

    /**
     *  Gets the gender escaped and capitalized.
     * 
     *  @return String      The escaped, capitilized gender
     */
    public function displayGender()
    { return !empty($this->gender) ? ucfirst(htmlspecialchars($this->gender)) : 'Unspecified'; }

    /**
     *  Sets the phone number.
     * 
     *  @param number $phone     The phone number
     */
    public function setPhone($phone)
    { $this->phone = $phone; }

    /**
     *  Gets the phone number.
     * 
     *  @return number      The phone number
     */
    public function getPhone()
    { return $this->phone; }

    /**
     *  Gets the phone number escaped.
     * 
     *  @return String      The escaped phone number
     */
    public function displayPhone()
    { return !empty($this->phone) ? htmlspecialchars($this->fname) : 'Unspecified'; }

    /**
     *  Sets the email.
     * 
     *  @param String $email     The email
     */
    public function setEmail($email)
    { $this->email = $email; }

    /**
     *  Gets the email.
     * 
     *  @return String      The email
     */
    public function getEmail()
    { return $this->email; }

    /**
     *  Gets the email, escaped.
     * 
     *  @return String      The escaped email
     */
    public function displayEmail()
    { return !empty($this->email) ? htmlspecialchars($this->fname) : 'Unspecified'; }

    /**
     *  Sets the state.
     * 
     *  @param String $state     The state
     */
    public function setState($state)
    { $this->state = $state; }

    /**
     *  Gets the state.
     * 
     *  @return String      The state
     */
    public function getState()
    { return $this->state; }

    /**
     *  Gets the state escaped and capitalized.
     * 
     *  @return String      The escaped, capitalized state
     */
    public function displayState()
    { return !empty($this->state) ? ucwords(htmlspecialchars($this->state)) : 'Unspecified'; }

    /**
     *  Sets the gender the user is seeking.
     * 
     *  @param String $seeking     The wanted gender
     */
    public function setSeeking($seeking)
    { $this->seeking = $seeking; }

    /**
     *  Gets the wanted gender.
     * 
     *  @return String      The wanted gender
     */
    public function getSeeking()
    { return $this->seeking; }

    /**
     *  Gets the gender escaped and capitalized.
     * 
     *  @return String      The escaped, capitalized gender
     */
    public function displaySeeking()
    { return !empty($this->seeking) ? ucfirst(htmlspecialchars($this->seeking)) : 'Unspecified'; }

    /**
     *  Sets the biography.
     * 
     *  @param String $bio     The biography
     */
    public function setBio($bio)
    { $this->bio = $bio; }

    /**
     *  Gets the biography.
     * 
     *  @return String      The biography
     */
    public function getBio()
    { return $this->bio; }

    /**
     *  Gets the biography escaped and capitalized.
     * 
     *  @return String      The escaped, capitalized biography
     */
    public function displayBio()
    { return !empty($this->bio) ? ucfirst(htmlspecialchars($this->bio)) : 'Unspecified'; }
}