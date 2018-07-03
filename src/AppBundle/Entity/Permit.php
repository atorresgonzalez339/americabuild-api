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
     * @ORM\Column(name="owner_builder", type="boolean", options={"default" : false})
     */
    private $ownerBuilder;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitFees", mappedBy="permit")
     */
    private $permitFees;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitImprovementType", inversedBy="permits")
     * @ORM\JoinColumn(
     *     name="improvementid",
     *     referencedColumnName="id",
     *     nullable=false)
     */
    private $typeOfImprovement;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitPermitType", mappedBy="permit")
     */
    private $permitPermitTypes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitRevision", mappedBy="permit")
     */
    private $permitRevisions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permitUsers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permitFees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permitPermitTypes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permitRevisions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add permitFees
     *
     * @param \AppBundle\Entity\PermitFees $permitFees
     * @return Permit
     */
    public function addPermitFee(\AppBundle\Entity\PermitFees $permitFees)
    {
        $this->permitFees[] = $permitFees;

        return $this;
    }

    /**
     * Remove permitFees
     *
     * @param \AppBundle\Entity\PermitFees $permitFees
     */
    public function removePermitFee(\AppBundle\Entity\PermitFees $permitFees)
    {
        $this->permitFees->removeElement($permitFees);
    }

    /**
     * Get permitFees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermitFees()
    {
        return $this->permitFees;
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
     * Add permitPermitTypes
     *
     * @param \AppBundle\Entity\PermitPermitType $permitPermitTypes
     * @return Permit
     */
    public function addPermitPermitType(\AppBundle\Entity\PermitPermitType $permitPermitTypes)
    {
        $this->permitPermitTypes[] = $permitPermitTypes;

        return $this;
    }

    /**
     * Remove permitPermitTypes
     *
     * @param \AppBundle\Entity\PermitPermitType $permitPermitTypes
     */
    public function removePermitPermitType(\AppBundle\Entity\PermitPermitType $permitPermitTypes)
    {
        $this->permitPermitTypes->removeElement($permitPermitTypes);
    }

    /**
     * Get permitPermitTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermitPermitTypes()
    {
        return $this->permitPermitTypes;
    }

    /**
     * Add permitRevision
     *
     * @param \AppBundle\Entity\PermitRevision $permitRevision
     *
     * @return Permit
     */
    public function addPermitRevision(\AppBundle\Entity\PermitRevision $permitRevision)
    {
        $this->permitRevisions[] = $permitRevision;

        return $this;
    }

    /**
     * Remove permitRevision
     *
     * @param \AppBundle\Entity\PermitRevision $permitRevision
     */
    public function removePermitRevision(\AppBundle\Entity\PermitRevision $permitRevision)
    {
        $this->permitRevisions->removeElement($permitRevision);
    }

    /**
     * Get permitRevisions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermitRevisions()
    {
        return $this->permitRevisions;
    }
}
