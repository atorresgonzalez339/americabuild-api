<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeesItem
 *
 * @ORM\Table(name="tbfees_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FeesItemRepository")
 */
class FeesItem
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitType", inversedBy="feesItems")
     * @ORM\JoinColumn(
     *     name="permit_type_id",
     *     referencedColumnName="id",
     *     nullable=true)
     */
    private $permitType;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CompanyFees", mappedBy="feesItem")
     */
    private $companyFees;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set description
     *
     * @param string $description
     * @return FeesItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set permitType
     *
     * @param \AppBundle\Entity\PermitType $permitType
     * @return FeesItem
     */
    public function setPermitType(\AppBundle\Entity\PermitType $permitType = null)
    {
        $this->permitType = $permitType;

        return $this;
    }

    /**
     * Get permitType
     *
     * @return \AppBundle\Entity\PermitType 
     */
    public function getPermitType()
    {
        return $this->permitType;
    }

    /**
     * Add companyFees
     *
     * @param \AppBundle\Entity\CompanyFees $companyFees
     * @return FeesItem
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
