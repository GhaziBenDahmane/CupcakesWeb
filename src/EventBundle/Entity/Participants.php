<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participants
 *
 * @ORM\Table(name="participants")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\ParticipantsRepository")
 */
class Participants
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
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="id_event", type="string", length=255)
     * @ORM\Column(name="id_participant", type="string", length=255)
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Event" ,inversedBy="id" )
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="id_participant", type="string", length=255)
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User" ,inversedBy="id" )
     */
    private $idParticipant;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Participants
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set idEvent.
     *
     * @param string $idEvent
     *
     * @return Participants
     */
    public function setIdEvent($idEvent)
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    /**
     * Get idEvent.
     *
     * @return string
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * Set idParticipant.
     *
     * @param string $idParticipant
     *
     * @return Participants
     */
    public function setIdParticipant($idParticipant)
    {
        $this->idParticipant = $idParticipant;

        return $this;
    }

    /**
     * Get idParticipant.
     *
     * @return string
     */
    public function getIdParticipant()
    {
        return $this->idParticipant;
    }
}
