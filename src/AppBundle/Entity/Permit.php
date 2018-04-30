<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permit
 *
 * @ORM\Table(name="tbpermit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitRepository")
 */
class Permit
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="folio_number", type="string", length=255)
     */
    private $folioNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="number_of_units", type="integer")
     */
    private $numberOfUnits;

    /**
     * @var string
     *
     * @ORM\Column(name="lot", type="string", length=255)
     */
    private $lot;

    /**
     * @var string
     *
     * @ORM\Column(name="block ",  type="string", length=255)
     */
    private $block ;

    /**
     * @var string
     *
     * @ORM\Column(name="subdivision", type="string", length=255)
     */
    private $subdivision;

    /**
     * @var string
     *
     * @ORM\Column(name="pbpg ",  type="string", length=255)
     */
    private $pbpg;

    /**
     * @var string
     *
     * @ORM\Column(name="current_use_of_property", type="string", length=255)
     */
    private $currentUseOfProperty;

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
     * @ORM\Column(name="owner_builder", type="boolean", options={"default" : false})
     */
    private $ownerBuilder;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="permits")
     * @ORM\JoinColumn(
     *     name="userid",
     *     referencedColumnName="id",
     *     nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitUser", mappedBy="permit")
     */
    private $permitUsers;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitImprovementType", inversedBy="permits")
     * @ORM\JoinColumn(
     *     name="improvementid",
     *     referencedColumnName="id",
     *     nullable=false)
     */
    private $typeOfImprovement;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Permit
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Permit
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set folioNumber
     *
     * @param string $folioNumber
     * @return Permit
     */
    public function setFolioNumber($folioNumber)
    {
        $this->folioNumber = $folioNumber;

        return $this;
    }

    /**
     * Get folioNumber
     *
     * @return string 
     */
    public function getFolioNumber()
    {
        return $this->folioNumber;
    }

    /**
     * Set numberOfUnits
     *
     * @param integer $numberOfUnits
     * @return Permit
     */
    public function setNumberOfUnits($numberOfUnits)
    {
        $this->numberOfUnits = $numberOfUnits;

        return $this;
    }

    /**
     * Get numberOfUnits
     *
     * @return integer 
     */
    public function getNumberOfUnits()
    {
        return $this->numberOfUnits;
    }

    /**
     * Set lot
     *
     * @param string $lot
     * @return Permit
     */
    public function setLot($lot)
    {
        $this->lot = $lot;

        return $this;
    }

    /**
     * Get lot
     *
     * @return string 
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * Set block
     *
     * @param string $block
     * @return Permit
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return string 
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set subdivision
     *
     * @param string $subdivision
     * @return Permit
     */
    public function setSubdivision($subdivision)
    {
        $this->subdivision = $subdivision;

        return $this;
    }

    /**
     * Get subdivision
     *
     * @return string 
     */
    public function getSubdivision()
    {
        return $this->subdivision;
    }

    /**
     * Set pbpg
     *
     * @param string $pbpg
     * @return Permit
     */
    public function setPbpg($pbpg)
    {
        $this->pbpg = $pbpg;

        return $this;
    }

    /**
     * Get pbpg
     *
     * @return string 
     */
    public function getPbpg()
    {
        return $this->pbpg;
    }

    /**
     * Set currentUseOfProperty
     *
     * @param string $currentUseOfProperty
     * @return Permit
     */
    public function setCurrentUseOfProperty($currentUseOfProperty)
    {
        $this->currentUseOfProperty = $currentUseOfProperty;

        return $this;
    }

    /**
     * Get currentUseOfProperty
     *
     * @return string 
     */
    public function getCurrentUseOfProperty()
    {
        return $this->currentUseOfProperty;
    }

    /**
     * Set descriptionOfWork
     *
     * @param string $descriptionOfWork
     * @return Permit
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
     * @return Permit
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
     * @return Permit
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
     * @return Permit
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
     * Set ownerBuilder
     *
     * @param boolean $ownerBuilder
     * @return Permit
     */
    public function setOwnerBuilder($ownerBuilder)
    {
        $this->ownerBuilder = $ownerBuilder;

        return $this;
    }

    /**
     * Get ownerBuilder
     *
     * @return boolean 
     */
    public function getOwnerBuilder()
    {
        return $this->ownerBuilder;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\PermitType $type
     * @return Permit
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Permit
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add permitUsers
     *
     * @param \AppBundle\Entity\PermitUser $permitUsers
     * @return Permit
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
     * Set typeOfImprovement
     *
     * @param \AppBundle\Entity\PermitImprovementType $typeOfImprovement
     * @return Permit
     */
    public function setTypeOfImprovement(\AppBundle\Entity\PermitImprovementType $typeOfImprovement)
    {
        $this->typeOfImprovement = $typeOfImprovement;

        return $this;
    }

    /**
     * Get typeOfImprovement
     *
     * @return \AppBundle\Entity\PermitImprovementType 
     */
    public function getTypeOfImprovement()
    {
        return $this->typeOfImprovement;
    }

    /**
     * Set gallons
     *
     * @param string $gallons
     * @return Permit
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
}
