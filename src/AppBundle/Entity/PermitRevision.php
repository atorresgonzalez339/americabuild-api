<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermitRevision
 *
 * @author Yosviel Dominguez <yosvield@gmail.com>
 *
 * @ORM\Table(name="tbpermit_revision")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitRevisionRepository")
 */
class PermitRevision
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
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitPermitType", inversedBy="permitRevisions")
     * @ORM\JoinColumn(
     *     name="permitpermittype_id",
     *     referencedColumnName="id",
     *     nullable=false,
     *     onDelete="CASCADE")
     */
    private $permitpermittype;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Revision", inversedBy="permitRevisions")
     * @ORM\JoinColumn(
     *     name="revision_id",
     *     referencedColumnName="id",
     *     nullable=false,
     *     onDelete="CASCADE")
     */
    private $revision;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     *
     * @return PermitRevision
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
     * Set permitpermittype
     *
     * @param \AppBundle\Entity\PermitPermitType $permitpermittype
     *
     * @return PermitRevision
     */
    public function setPermitpermittype(\AppBundle\Entity\PermitPermitType $permitpermittype)
    {
        $this->permitpermittype = $permitpermittype;

        return $this;
    }

    /**
     * Get permitpermittype
     *
     * @return \AppBundle\Entity\PermitPermitType
     */
    public function getPermitpermittype()
    {
        return $this->permitpermittype;
    }

    /**
     * Set revision
     *
     * @param \AppBundle\Entity\Revision $revision
     *
     * @return PermitRevision
     */
    public function setRevision(\AppBundle\Entity\Revision $revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision
     *
     * @return \AppBundle\Entity\Revision
     */
    public function getRevision()
    {
        return $this->revision;
    }
}
