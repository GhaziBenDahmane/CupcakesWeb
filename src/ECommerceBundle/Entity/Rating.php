<?php

namespace ECommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity(repositoryClass="ECommerceBundle\Repository\RatingRepository")
 */
class Rating
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
     * @ORM\Column(name="note", type="integer")
     */
    private $note;



    /**
     * @ORM\ManyToOne(targetEntity="ECommerceBundle\Entity\Product" , inversedBy="id")
     */
    private  $products;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_votes", type="integer")
     */
    private $nb_votes;

    /**
     * @return int
     */
    public function getNbVotes()
    {
        return $this->nb_votes;
    }

    /**
     * @param int $nb_votes
     */
    public function setNbVotes($nb_votes)
    {
        $this->nb_votes = $nb_votes;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
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
     * Set note
     *
     * @param integer $note
     *
     * @return Rating
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }
}

