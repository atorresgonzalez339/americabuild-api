<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermitFees
 *
 * @ORM\Table(name="tbpermit_fees")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitFeesRepository")
 */
class PermitFees
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
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @var float
     *
     * @ORM\Column(name="permitFeesValue", type="float")
     */
    private $permitFeesValue;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CompanyFees", inversedBy="permitFees")
     * @ORM\JoinColumn(
     *     name="company_fees_id",
     *     referencedColumnName="id",
     *     nullable=false)
     */
    private $companyFees;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Permit", inversedBy="permitFees")
     * @ORM\JoinColumn(
     *     name="permit_id",
     *     referencedColumnName="id",
     *     nullable=false,
     *     onDelete="CASCADE")
     */
    private $permit;

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
     * Set value
     *
     * @param float $value
     * @return PermitFees
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set permitFeesValue
     *
     * @param float $permitFeesValue
     * @return PermitFees
     */
    public function setPermitFeesValue($permitFeesValue)
    {
        $this->permitFeesValue = $permitFeesValue;

        return $this;
    }

    /**
     * Get permitFeesValue
     *
     * @return float 
     */
    public function getPermitFeesValue()
    {
        return $this->permitFeesValue;
    }

    /**
     * Set companyFees
     *
     * @param \AppBundle\Entity\CompanyFees $companyFees
     * @return PermitFees
     */
    public function setCompanyFees(\AppBundle\Entity\CompanyFees $companyFees)
    {
        $this->companyFees = $companyFees;

        return $this;
    }

    /**
     * Get companyFees
     *
     * @return \AppBundle\Entity\CompanyFees 
     */
    public function getCompanyFees()
    {
        return $this->companyFees;
    }

    /**
     * Set permit
     *
     * @param \AppBundle\Entity\Permit $permit
     * @return PermitFees
     */
    public function setPermit(\AppBundle\Entity\Permit $permit)
    {
        $this->permit = $permit;

        return $this;
    }

    /**
     * Get permit
     *
     * @return \AppBundle\Entity\Permit 
     */
    public function getPermit()
    {
        return $this->permit;
    }
}
