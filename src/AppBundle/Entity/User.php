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
 * @UniqueEntity(fields={"licenseNumber"}, message="A user with the same license number already exist")
 */
class User implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="license_number", type="string", length=255, unique=true, nullable=true)
     */
    private $licenseNumber;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role",inversedBy="users")
     * @ORM\JoinTable(name="tbuser_role",
     *          joinColumns={
     *              @ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE")
     *          },
     *          inverseJoinColumns={
     *              @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *          }
     * )
     */
    private $roles;

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


    public function eraseCredentials()
    {
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {

        $roles = array();
        foreach ($this->roles as $role) {
            $roles[] = $role->getRole();
        }

        return $roles;
    }

    public function getRole()
    {
        return $this->roles;
    }

    public function getSalt()
    {
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
     * Constructor
     */
    public function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permits = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fullname
     *
     * @param string $fullname
     * @return User
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
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

    /**
     * Set licenseNumber
     *
     * @param string $licenseNumber
     * @return User
     */
    public function setLicenseNumber($licenseNumber)
    {
        $this->licenseNumber = $licenseNumber;

        return $this;
    }

    /**
     * Get licenseNumber
     *
     * @return string
     */
    public function getLicenseNumber()
    {
        return $this->licenseNumber;
    }

    /**
     * Add roles
     *
     * @param \AppBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\AppBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \AppBundle\Entity\Role $roles
     */
    public function removeRole(\AppBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
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
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     * @return User
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
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

}
