<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/** 
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1483A5E9DFDCDFE1", columns={"usr_name"})})
 * @ORM\Entity(repositoryClass="Blog\Entity\Repository\UserRepository")
 * @Annotation\Name("user")
 */
class User
{
    /** 
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Exclude()
     */
    private $id;

    /** 
     * @var string
     *
     * @ORM\Column(name="usr_name", type="string", length=100, nullable=false)
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Attributes({"type":"text", "class":"form-control", "required":"required"})
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"Login:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     */
    private $usrName;

    /** 
     * @var string
     *
     * @ORM\Column(name="usr_password", type="string", length=100, nullable=false)
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Attributes({"type":"password", "class":"form-control", "required":"required"})
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"Password:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     */
    private $usrPassword;
    
    /** 
     * @Annotation\Type("Password")
     * @Annotation\Attributes({"class":"form-control", "class":"form-control"})
     * @Annotation\Options({"label":"Repeat your password:"})
     * @Annotation\Validator({"name":"identical", "options":{"token":"usrPassword"}})
     */
    public $usrPasswordConfirm;
    
    /** 
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"class":"btn btn-primary", "value":"Login", "id":"btn_submit", "style":"display:block"})
     * @Annotation\AllowEmpty({"allowempty":"true"})
     */
    public $submit;

    /** 
     * @var string
     *
     * @ORM\Column(name="usr_email", type="string", length=60, nullable=false)
     * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Attributes({"class":"form-control", "required":"required"})
     * @Annotation\Required({"required":"true"})
     * @Annotation\Options({"label":"Email:"})
     * @Annotation\Validator({"name":"EmailAddress"})
     */
    private $usrEmail;

    /** 
     * @var string
     *
     * @ORM\Column(name="usr_password_salt", type="string", length=100, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Salt:"})
     */
    private $usrPasswordSalt;

    /** 
     * @var \DateTime
     *
     * @ORM\Column(name="usr_registration_date", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"datetime", "class":"form-control", "min":"2010-01-01T00:00:00Z", "max":"2020-01-01T00:00:00Z", "step":"1"})
     * @Annotation\Options({"label":"Registration date:"})
     */
    private $usrRegistrationDate;

    public function __construct() {
        $this->usrRegistrationDate = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set usrName
     *
     * @param string $usrName
     *
     * @return User
     */
    public function setUsrName($usrName)
    {
        $this->usrName = $usrName;

        return $this;
    }

    /**
     * Get usrName
     *
     * @return string
     */
    public function getUsrName()
    {
        return $this->usrName;
    }

    /**
     * Set usrPassword
     *
     * @param string $usrPassword
     *
     * @return User
     */
    public function setUsrPassword($usrPassword)
    {
        $this->usrPassword = $usrPassword;

        return $this;
    }

    /**
     * Get usrPassword
     *
     * @return string
     */
    public function getUsrPassword()
    {
        return $this->usrPassword;
    }

    /**
     * Set usrEmail
     *
     * @param string $usrEmail
     *
     * @return User
     */
    public function setUsrEmail($usrEmail)
    {
        $this->usrEmail = $usrEmail;

        return $this;
    }

    /**
     * Get usrEmail
     *
     * @return string
     */
    public function getUsrEmail()
    {
        return $this->usrEmail;
    }

    /**
     * Set usrPasswordSalt
     *
     * @param string $usrPasswordSalt
     *
     * @return User
     */
    public function setUsrPasswordSalt($usrPasswordSalt)
    {
        $this->usrPasswordSalt = $usrPasswordSalt;

        return $this;
    }

    /**
     * Get usrPasswordSalt
     *
     * @return string
     */
    public function getUsrPasswordSalt()
    {
        return $this->usrPasswordSalt;
    }

    /**
     * Set usrRegistrationDate
     *
     * @param \DateTime $usrRegistrationDate
     *
     * @return User
     */
    public function setUsrRegistrationDate($usrRegistrationDate)
    {
        $this->usrRegistrationDate = $usrRegistrationDate;

        return $this;
    }

    /**
     * Get usrRegistrationDate
     *
     * @return \DateTime
     */
    public function getUsrRegistrationDate()
    {
        return $this->usrRegistrationDate;
    }
}
