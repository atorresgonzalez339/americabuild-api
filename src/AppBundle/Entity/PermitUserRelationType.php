<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermitUserRelationType
 *
 * @ORM\Table(name="tbpermit_user_relation_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitUserRelationTypeRepository")
 */
class PermitUserRelationType
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitUser", mappedBy="permitUserRelationType")
     */
    private $permitUsers;
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
     * Set name
     *
     * @param string $name
     * @return PermitUserRelationType
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
     * @return PermitUserRelationType
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
     * @return PermitUserRelationType
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
     * Add permitUsers
     *
     * @param \AppBundle\Entity\PermitUser $permitUsers
     * @return PermitUserRelationType
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
}