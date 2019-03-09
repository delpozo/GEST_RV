<?php

namespace Abonnement\RevendeurBundle\Entity;


/**
 * produit_rev
 */
class produit_rev
{
    /**
     * @var int
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    

    public function __toString() {
        return $this->getId();
    }
}

