<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Users
 *
 * @ORM\Table(name="tbuser")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="A user with the same email already exist")
 */
class User implements UserInterface {

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
     * @ORM\Column(name="username", type="string", length=255,unique=true,nullable=false)
     * @Assert\Email(message="validation.email.error")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="validationToken", type="text", nullable=true)
     */
    private $validationToken;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="boolean", options={"default" : false})
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="text",nullable=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=10, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(
     *     name="idrole",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserType", inversedBy="users")
     * @ORM\JoinColumn(
     *     name="idusertype",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    private $userType;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="users")
     * @ORM\JoinColumn(
     *     name="companyid",
     *     referencedColumnName="id",
     *     nullable=true)
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Permit", mappedBy="user")
     */
    private $permits;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitUser", mappedBy="user")
     */
    private $permitUsers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->permits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permitUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function eraseCredentials() {}

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return array($this->role->getRole());
    }

    public function getSalt() {
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $fullname
     * @return User
     */
    public function setFullName($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullname;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        if (!empty($password)) {

            $encode = new MessageDigestPasswordEncoder(
                'sha512', false,1
            );

            $this->password = $encode->encodePassword($password, $this->salt);
        }
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set validationToken
     *
     * @param string $validationToken
     * @return User
     */
    public function setValidationToken($validationToken)
    {
        $this->validationToken = $validationToken;

        return $this;
    }

    /**
     * Get validationToken
     *
     * @return string
     */
    public function getValidationToken()
    {
        return $this->validationToken;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set role
     *
     * @param \AppBundle\Entity\Role $role
     * @return User
     */
    public function setRole(\AppBundle\Entity\Role $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \AppBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     * @return User
     */
    public function setCompany(\AppBundle\Entity\Company $company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * Add permits
     *
     * @param \AppBundle\Entity\Permit $permits
     * @return User
     */
    public function addPermit(\AppBundle\Entity\Permit $permits)
    {
        $this->permits[] = $permits;

        return $this;
    }

    /**
     * Remove permits
     *
     * @param \AppBundle\Entity\Permit $permits
     */
    public function removePermit(\AppBundle\Entity\Permit $permits)
    {
        $this->permits->removeElement($permits);
    }

    /**
     * Get permits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermits()
    {
        return $this->permits;
    }

    /**
     * Add permitUsers
     *
     * @param \AppBundle\Entity\PermitUser $permitUsers
     * @return User
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

    /**
     * Set userType
     *
     * @param \AppBundle\Entity\UserType $userType
     * @return User
     */
    public function setUserType(\AppBundle\Entity\UserType $userType = null)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return \AppBundle\Entity\UserType 
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
}
