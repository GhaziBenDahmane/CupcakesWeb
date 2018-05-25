<?php

namespace ECommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="ECommerceBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_viewed", type="integer", nullable=true)
     */
    private $nb_viewed;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_seller", type="integer", nullable=true)
     */
    private $nb_seller;

    /**
     * @var int
     *
     * @ORM\Column(name="barcode", type="integer", nullable=true)
     */
    private $barcode;


    /**
     * @var string
     * @ORM\Column(name="photo" ,type="string", length=255)
     * @Assert\File()
     */
    private $photo;

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }





    /**
     * @return int
     */
    public function getNbViewed()
    {
        return $this->nb_viewed;
    }

    /**
     * @param int $nb_viewed
     */
    public function setNbViewed($nb_viewed)
    {
        $this->nb_viewed = $nb_viewed;
    }

    /**
     * @return mixed
     */
    public function getNbSeller()
    {
        return $this->nb_seller;
    }

    /**
     * @param mixed $nb_seller
     */
    public function setNbSeller($nb_seller)
    {
        $this->nb_seller = $nb_seller;
    }


    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @ORM\ManyToOne(targetEntity="ECommerceBundle\Entity\Promotion" , inversedBy="id")
     */
    private $promotion;

    /**
     * @return mixed
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * @param mixed $promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set type
     *
     * @param string $type
     *
     * @return Product
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
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param int $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }





}
