<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PermitUserProfile
 *
 * @ORM\Table(name="tbpermit_user_profile")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitUserProfileRepository")
 */
class PermitUserProfile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=255)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=255)
     */
    private $zip;

    /**
     * @var int
     *
     * @ORM\Column(name="phone_number", type="integer")
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message="validation.email.error")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_lic_or_id", type="string", length=255)
     */
    private $driverLicOrId;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitUser", mappedBy="permitUserProfile")
     */
    private $permitUsers;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permitUsers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return PermitUserProfile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address1
     *
     * @param string $address1
     * @return PermitUserProfile
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return PermitUserProfile
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return PermitUserProfile
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return PermitUserProfile
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return PermitUserProfile
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     * @return PermitUserProfile
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return integer 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return PermitUserProfile
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set driverLicOrId
     *
     * @param string $driverLicOrId
     * @return PermitUserProfile
     */
    public function setDriverLicOrId($driverLicOrId)
    {
        $this->driverLicOrId = $driverLicOrId;

        return $this;
    }

    /**
     * Get driverLicOrId
     *
     * @return string 
     */
    public function getDriverLicOrId()
    {
        return $this->driverLicOrId;
    }

    /**
     * Add permitUsers
     *
     * @param \AppBundle\Entity\PermitUser $permitUsers
     * @return PermitUserProfile
     */
    public function addPermitUser(\AppBundle\Entity\PermitUser $permitUsers)
    {
        $this->permitUsers[] = $permitUsers;

        return $this;
    }

    /**
     * Remove permitUsers
     *
     * @param \AppBundle\Entity\PermitUser $permitUsers
     */
    public function removePermitUser(\AppBundle\Entity\PermitUser $permitUsers)
    {
        $this->permitUsers->removeElement($permitUsers);
    }

    /**
     * Get permitUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermitUsers()
    {
        return $this->permitUsers;
    }
}
