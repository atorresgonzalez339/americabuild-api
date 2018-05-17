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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CompanyFees", mappedBy="company")
     */
    private $companyFees;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->companyFees = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $companyName
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
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set subdomain
     *
     * @param string $subdomain
     * @return Company
     */
    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;

        return $this;
    }

    /**
     * Get subdomain
     *
     * @return string 
     */
    public function getSubdomain()
    {
        return $this->subdomain;
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
     * Remove users
     *
     * @param \AppBundle\Entity\User $users
     */
    public function removeUser(\AppBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add companyFees
     *
     * @param \AppBundle\Entity\CompanyFees $companyFees
     * @return Company
     */
    public function addCompanyFee(\AppBundle\Entity\CompanyFees $companyFees)
    {
        $this->companyFees[] = $companyFees;

        return $this;
    }

    /**
     * Remove companyFees
     *
     * @param \AppBundle\Entity\CompanyFees $companyFees
     */
    public function removeCompanyFee(\AppBundle\Entity\CompanyFees $companyFees)
    {
        $this->companyFees->removeElement($companyFees);
    }

    /**
     * Get companyFees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompanyFees()
    {
        return $this->companyFees;
    }
}
