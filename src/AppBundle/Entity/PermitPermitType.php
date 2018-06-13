<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permit
 *
 * @ORM\Table(name="tbpermit_permit_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitPermitTypeRepository")
 */
class PermitPermitType
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
     * @ORM\Column(name="description_of_work ",  type="text")
     */
    private $descriptionOfWork;

    /**
     * @var string
     *
     * @ORM\Column(name="estimate_value", type="decimal", precision=15, scale=8)
     */
    private $estimateValue;

    /**
     * @var string
     *
     * @ORM\Column(name="area ",  type="decimal", precision=15, scale=8)
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="length ",  type="decimal",  precision=15, scale=8)
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="gallons", type="string", length=255)
     */
    private $gallons;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitType", inversedBy="permits")
     * @ORM\JoinColumn(
     *     name="typeid",
     *     referencedColumnName="id",
     *     nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Permit", inversedBy="permitPermitTypes")
     * @ORM\JoinColumn(
     *     name="permitid",
     *     referencedColumnName="id",
     *     nullable=false)
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
     * Set descriptionOfWork
     *
     * @param string $descriptionOfWork
     * @return PermitPermitType
     */
    public function setDescriptionOfWork($descriptionOfWork)
    {
        $this->descriptionOfWork = $descriptionOfWork;

        return $this;
    }

    /**
     * Get descriptionOfWork
     *
     * @return string 
     */
    public function getDescriptionOfWork()
    {
        return $this->descriptionOfWork;
    }

    /**
     * Set estimateValue
     *
     * @param string $estimateValue
     * @return PermitPermitType
     */
    public function setEstimateValue($estimateValue)
    {
        $this->estimateValue = $estimateValue;

        return $this;
    }

    /**
     * Get estimateValue
     *
     * @return string 
     */
    public function getEstimateValue()
    {
        return $this->estimateValue;
    }

    /**
     * Set area
     *
     * @param string $area
     * @return PermitPermitType
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return PermitPermitType
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set gallons
     *
     * @param string $gallons
     * @return PermitPermitType
     */
    public function setGallons($gallons)
    {
        $this->gallons = $gallons;

        return $this;
    }

    /**
     * Get gallons
     *
     * @return string 
     */
    public function getGallons()
    {
        return $this->gallons;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\PermitType $type
     * @return PermitPermitType
     */
    public function setType(\AppBundle\Entity\PermitType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\PermitType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set permit
     *
     * @param \AppBundle\Entity\Permit $permit
     * @return PermitPermitType
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
