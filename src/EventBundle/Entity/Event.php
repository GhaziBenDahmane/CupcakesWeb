<?php

namespace EventBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use fadosProduccions\fullCalendarBundle\Entity\Event as BaseEvent;


/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
 */
class Event extends BaseEvent
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
     * @var int
     *
     * @ORM\Column(name="nb_person", type="integer")
     */
    private $nbPerson;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_table", type="integer")
     */
    private $nbTable;

    /**
     * @var bool
     *
     * @ORM\Column(name="band", type="boolean")
     */
    private $band;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float")
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User" , inversedBy="id")
     */
    private $client;

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
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
     * Set nbPerson
     *
     * @param integer $nbPerson
     *
     * @return Event
     */
    public function setNbPerson($nbPerson)
    {
        $this->nbPerson = $nbPerson;

        return $this;
    }

    /**
     * Get nbPerson
     *
     * @return int
     */
    public function getNbPerson()
    {
        return $this->nbPerson;
    }

    /**
     * Set nbTable
     *
     * @param integer $nbTable
     *
     * @return Event
     */
    public function setNbTable($nbTable)
    {
        $this->nbTable = $nbTable;

        return $this;
    }

    /**
     * Get nbTable
     *
     * @return int
     */
    public function getNbTable()
    {
        return $this->nbTable;
    }

    /**
     * Set band
     *
     * @param boolean $band
     *
     * @return Event
     */
    public function setBand($band)
    {
        $this->band = $band;

        return $this;
    }

    /**
     * Get band
     *
     * @return bool
     */
    public function getBand()
    {
        return $this->band;
    }

    /**
     * Set cout
     *
     * @param float $cout
     *
     * @return Event
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

}

