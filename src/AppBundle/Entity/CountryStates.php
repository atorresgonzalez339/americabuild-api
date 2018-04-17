<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CountryStates
 *
 * @ORM\Table(name="tbcountry_states")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryStatesRepository")
 */
class CountryStates
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
     * @ORM\Column(name="code", type="string", length=2, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PermitUserProfile", mappedBy="state")
     */
    private $permitUserProfiles;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permitUserProfiles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return CountryStates
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CountryStates
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
     * Add permitUserProfiles
     *
     * @param \AppBundle\Entity\PermitUserProfile $permitUserProfiles
     * @return CountryStates
     */
    public function addPermitUserProfile(\AppBundle\Entity\PermitUserProfile $permitUserProfiles)
    {
        $this->permitUserProfiles[] = $permitUserProfiles;

        return $this;
    }

    /**
     * Remove permitUserProfiles
     *
     * @param \AppBundle\Entity\PermitUserProfile $permitUserProfiles
     */
    public function removePermitUserProfile(\AppBundle\Entity\PermitUserProfile $permitUserProfiles)
    {
        $this->permitUserProfiles->removeElement($permitUserProfiles);
    }

    /**
     * Get permitUserProfiles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermitUserProfiles()
    {
        return $this->permitUserProfiles;
    }
}
