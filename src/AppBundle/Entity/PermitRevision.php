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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Permit", inversedBy="permitRevisions")
     * @ORM\JoinColumn(
     *     name="permit_id",
     *     referencedColumnName="id",
     *     nullable=false,
     *     onDelete="CASCADE")
     */
    private $permit;

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
     * Set permit
     *
     * @param \AppBundle\Entity\Permit $permit
     *
     * @return PermitRevision
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
}
