<?php

namespace ECommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table(name="livraison")
 * @ORM\Entity(repositoryClass="ECommerceBundle\Repository\DeliveryRepository")
 */
class Delivery
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @return mixed
     */
    public function getPhone ()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone ($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName ($name)
    {
        $this->name = $name;
    }
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_delivery", type="date")
     */
    private $dateDelivery;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="contact_time", type="date")
     */
    private $contactTime;

    /**
     * @ORM\Column(type="string")
     */
    private $notes;


    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @return mixed
     */
    public function getEmail ()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail ($email)
    {
        $this->email = $email;
    }


    /**
     * @return \DateTime
     */
    public function getContactTime ()
    {
        return $this->contactTime;
    }

    /**
     * @param \DateTime $contactTime
     */
    public function setContactTime ($contactTime)
    {
        $this->contactTime = $contactTime;
    }

    /**
     * @return mixed
     */
    public function getNotes ()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes ($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getAdress ()
    {
        return $this->adress;
    }

    /**
     * @param mixed $adress
     */
    public function setAdress ($adress)
    {
        $this->adress = $adress;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $adress;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float")
     */

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
     * Set dateDelivery
     *
     * @param \DateTime $dateDelivery
     *
     * @return Delivery
     */
    public function setDateDelivery($dateDelivery)
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    /**
     * Get dateDelivery
     *
     * @return \DateTime
     */
    public function getDateDelivery()
    {
        return $this->dateDelivery;
    }


}

