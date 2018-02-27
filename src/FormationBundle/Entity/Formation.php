<?php

namespace FormationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="cupCake_formation")
 * @ORM\Entity(repositoryClass="FormationBundle\Repository\FormationRepository")
 */
class Formation
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="text")
     */
    private $video;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date_Formation", type="date")
     */
    private $startDateFormation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date_Formation", type="date")
     */

    private $endDateFormation;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User" , inversedBy="id")
     */
    private $users;

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Formation
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return Formation
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set startDateFormation
     *
     * @param \DateTime $dateDebutFormation
     *
     * @return Formation
     */
    public function setStartDateFormation($startDateFormation)
    {
        $this->startDateFormation = $startDateFormation;

        return $this;
    }

    /**
     * Get startDateFormation
     *
     * @return \DateTime
     */
    public function getStartDateFormation()
    {
        return $this->startDateFormation;
    }

    /**
     * Set endDateFormation
     *
     * @param \DateTime $endDateFormation
     *
     * @return Formation
     */
    public function setEndDateFormation($endDateFormation)
    {
        $this->endDateFormation = $endDateFormation;

        return $this;
    }

    /**
     * Get endDateFormation
     *
     * @return \DateTime
     */
    public function getEndDateFormation()
    {
        return $this->endDateFormation;
    }
}
