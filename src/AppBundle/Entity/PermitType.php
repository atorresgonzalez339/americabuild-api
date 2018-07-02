<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermitType
 *
 * @ORM\Table(name="tbpermit_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitTypeRepository")
 */
class PermitType
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Permit", mappedBy="type")
     */
    private $permits;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FeesItem", mappedBy="permitType")
     */
    private $feesItems;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Revisions", mappedBy="permitType")
     */
    private $revisions;

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
     * @return PermitType
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
     * @return PermitType
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
     * @return PermitType
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
     * @param \AppBundle\Entity\Permit $permits
     * @return PermitType
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
     * Constructor
     */
    public function __construct()
    {
        $this->permits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->feesItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add feesItems
     *
     * @param \AppBundle\Entity\FeesItem $feesItems
     * @return PermitType
     */
    public function addFeesItem(\AppBundle\Entity\FeesItem $feesItems)
    {
        $this->feesItems[] = $feesItems;

        return $this;
    }

    /**
     * Remove feesItems
     *
     * @param \AppBundle\Entity\FeesItem $feesItems
     */
    public function removeFeesItem(\AppBundle\Entity\FeesItem $feesItems)
    {
        $this->feesItems->removeElement($feesItems);
    }

    /**
     * Get feesItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFeesItems()
    {
        return $this->feesItems;
    }
}
