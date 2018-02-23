<?php

namespace TrainingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Training
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="TrainingBundle\Repository\TrainingRepository")
 */
class Training
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
     * @var string
     *
     * @ORM\Column(name="video", type="text")
     */
    private $video;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date_training", type="date")
     */
    private $startDateTraining;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date_training", type="date")
     */

    private $endDateTraining;

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
     * @return Training
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
     * @return Training
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
     * Set startDateTraining
     *
     * @param \DateTime $dateDebutFormation
     *
     * @return Training
     */
    public function setStartDateTraining($startDateTraining)
    {
        $this->startDateTraining = $startDateTraining;

        return $this;
    }

    /**
     * Get startDateTraining
     *
     * @return \DateTime
     */
    public function getStartDateTraining()
    {
        return $this->startDateTraining;
    }

    /**
     * Set endDateTraining
     *
     * @param \DateTime $endDateTraining
     *
     * @return Training
     */
    public function setEndDateTraining($endDateTraining)
    {
        $this->endDateTraining = $endDateTraining;

        return $this;
    }

    /**
     * Get endDateTraining
     *
     * @return \DateTime
     */
    public function getEndDateTraining()
    {
        return $this->endDateTraining;
    }
}

