<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Revisions
 *
 * @author Yosviel Dominguez <yosvield@gmail.com>
 *
 * @ORM\Table(name="tbrevisions")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RevisionsRepository")
 */
class Revisions
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
     * @return Revisions
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
     * @return Revisions
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
     * @return Revisions
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
}
