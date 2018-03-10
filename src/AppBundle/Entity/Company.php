<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name ="tbcompany")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company
{

    /**
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="companyName", length=255)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", name="subdomain", length=255)
     */
    private $subdomain;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="company")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Company
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * Set companyName
     *
     * @param String $companyName
     * @return Company
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * Get companyName
     *
     * @return String
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set domain
     *
     * @param String $subdomain
     * @return Company
     */
    public function setSubDomain($subdomain)
    {
        $this->subdomain = $subdomain;
        return $this;
    }

    /**
     * Get domain
     *
     * @return String
     */
    public function getSubDomain()
    {
        return $this->subdomain;
    }

    /**
     * Get users
     *
     * @return \AppBundle\Entity\Company
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add users
     *
     * @param \AppBundle\Entity\User $users
     * @return Company
     */
    public function addUser(\AppBundle\Entity\User $users)
    {
        $this->users[] = $users;
        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $users
     */
    public function removeUser(\AppBundle\Entity\User $users)
    {
        $this->user->removeElement($users);
    }

}
