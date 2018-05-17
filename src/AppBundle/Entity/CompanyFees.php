<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyFees
 *
 * @ORM\Table(name="tbcompany_fees")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyFeesRepository")
 */
class CompanyFees
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="companyFees")
     * @ORM\JoinColumn(
     *     name="company_id",
     *     referencedColumnName="id",
     *     nullable=false,
     *     onDelete="CASCADE")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FeesItem", inversedBy="companyFees")
     * @ORM\JoinColumn(
     *     name="fees_id",
     *     referencedColumnName="id",
     *     nullable=false,
     *     onDelete="CASCADE")
     */
    private $feesItem;

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
     * @return CompanyFees
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
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     * @return CompanyFees
     */
    public function setCompany(\AppBundle\Entity\Company $company)
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
     * Set feesItem
     *
     * @param \AppBundle\Entity\FeesItem $feesItem
     * @return CompanyFees
     */
    public function setFeesItem(\AppBundle\Entity\FeesItem $feesItem)
    {
        $this->feesItem = $feesItem;

        return $this;
    }

    /**
     * Get feesItem
     *
     * @return \AppBundle\Entity\FeesItem 
     */
    public function getFeesItem()
    {
        return $this->feesItem;
    }
}
