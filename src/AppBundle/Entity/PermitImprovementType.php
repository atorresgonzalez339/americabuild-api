<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermitImprovementType
 *
 * @ORM\Table(name="tbpermit_improvement_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitImprovementTypeRepository")
 */
class PermitImprovementType
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, unique=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitChangeType", mappedBy="typeOfImprovement")
     */
    private $permits;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permits = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return PermitImprovementType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PermitImprovementType
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
     * Set type
     *
     * @param string $type
     * @return PermitImprovementType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add permits
     *
     * @param \AppBundle\Entity\PermitChangeType $permits
     * @return PermitImprovementType
     */
    public function addPermit(\AppBundle\Entity\PermitChangeType $permits)
    {
        $this->permits[] = $permits;

        return $this;
    }

    /**
     * Remove permits
     *
     * @param \AppBundle\Entity\PermitChangeType $permits
     */
    public function removePermit(\AppBundle\Entity\PermitChangeType $permits)
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
}