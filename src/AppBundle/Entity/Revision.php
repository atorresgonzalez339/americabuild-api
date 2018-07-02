<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Revision
 *
 * @author Yosviel Dominguez <yosvield@gmail.com>
 *
 * @ORM\Table(name="tbrevision")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RevisionRepository")
 */
class Revision
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
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitType", inversedBy="revisions")
     * @ORM\JoinColumn(
     *     name="permit_type_id",
     *     referencedColumnName="id",
     *     nullable=false)
     */
    private $permitType;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitRevision", mappedBy="revision")
     */
    private $permitRevisions;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     *
     * @return Revision
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
     *
     * @return Revision
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
     *
     * @return Revision
     */
    public function setPermitType(\AppBundle\Entity\PermitType $permitType)
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
     * Add permitRevision
     *
     * @param \AppBundle\Entity\PermitRevision $permitRevision
     *
     * @return Revision
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
