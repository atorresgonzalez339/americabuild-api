<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermitUser
 *
 * @ORM\Table(name="tbpermit_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermitUserRepository")
 */
class PermitUser
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="permitUsers")
     * @ORM\JoinColumn(
     *     name="userid",
     *     referencedColumnName="id",
     *     nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Permit", inversedBy="permitUsers")
     * @ORM\JoinColumn(
     *     name="permitid",
     *     referencedColumnName="id",
     *     nullable=true,
     *     onDelete="CASCADE")
     */
    private $permit;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitUserRelationType", inversedBy="permitUsers")
     * @ORM\JoinColumn(
     *     name="permiturtid",
     *     referencedColumnName="id",
     *     nullable=true)
     */
    private $permitUserRelationType;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PermitUserProfile", inversedBy="permitUsers")
     * @ORM\JoinColumn(
     *     name="permituserpid",
     *     referencedColumnName="id",
     *     nullable=true)
     */
    private $permitUserProfile;

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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return PermitUser
     */
    public function setUser(\AppBundle\Entity\User $user = null)
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
     * Set permit
     *
     * @param \AppBundle\Entity\Permit $permit
     * @return PermitUser
     */
    public function setPermit(\AppBundle\Entity\Permit $permit = null)
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
     * Set permitUserRelationType
     *
     * @param \AppBundle\Entity\PermitUserRelationType $permitUserRelationType
     * @return PermitUser
     */
    public function setPermitUserRelationType(\AppBundle\Entity\PermitUserRelationType $permitUserRelationType = null)
    {
        $this->permitUserRelationType = $permitUserRelationType;

        return $this;
    }

    /**
     * Get permitUserRelationType
     *
     * @return \AppBundle\Entity\PermitUserRelationType 
     */
    public function getPermitUserRelationType()
    {
        return $this->permitUserRelationType;
    }

    /**
     * Set permitUserProfile
     *
     * @param \AppBundle\Entity\PermitUserProfile $permitUserProfile
     * @return PermitUser
     */
    public function setPermitUserProfile(\AppBundle\Entity\PermitUserProfile $permitUserProfile = null)
    {
        $this->permitUserProfile = $permitUserProfile;

        return $this;
    }

    /**
     * Get permitUserProfile
     *
     * @return \AppBundle\Entity\PermitUserProfile 
     */
    public function getPermitUserProfile()
    {
        return $this->permitUserProfile;
    }
}
