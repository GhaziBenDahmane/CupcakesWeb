<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\Column(name="date_reservation", type="date")
     */
    private $dateReservation;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_table", type="integer")
     */
    private $nbTable;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_person", type="integer")
     */
    private $nbPerson;


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
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set nbTable
     *
     * @param integer $nbTable
     *
     * @return Reservation
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
     * Set nbPerson
     *
     * @param integer $nbPerson
     *
     * @return Reservation
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
}

