<?php

namespace ECommerceBundle\Repository;

/**
 * CartRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByUser($id)
    {
        $query=$this->getEntityManager()
            ->createQuery(" SELECT c FROM ECommerceBundle:Cart c where IDENTITY(c.user)= :user_id")
            ->setParameter('user_id',$id);


        return $query->getResult();


    }

    public function findByProduct($idp,$idu)
    {
        $query=$this->getEntityManager()
            ->createQuery(" SELECT c FROM ECommerceBundle:Cart c where IDENTITY(c.product)= :product_id
            AND IDENTITY(c.user)= :user_id ")
            ->setParameter('product_id',$idp)
            ->setParameter('user_id',idu);


        return $query->getResult();


    }
}
