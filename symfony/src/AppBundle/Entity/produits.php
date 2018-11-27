<?php

namespace AppBundle\Entity;

/**
 * produits
 */
class produits
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idFour;

    /**
     * @var float
     */
    private $prixAchat;

    /**
     * @var float
     */
    private $prixVend;

    /**
     * @var float
     */
    private $prixVendRev;

    /**
     * @var bool
     */
    private $vendu;


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
     * Set idFour
     *
     * @param integer $idFour
     *
     * @return produits
     */
    public function setIdFour($idFour)
    {
        $this->idFour = $idFour;

        return $this;
    }

    /**
     * Get idFour
     *
     * @return int
     */
    public function getNomFour()
    {
        return $this->idFour;
    }

    /**
     * Set prixAchat
     *
     * @param float $prixAchat
     *
     * @return produits
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return float
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set prixVend
     *
     * @param float $prixVend
     *
     * @return produits
     */
    public function setPrixVend($prixVend)
    {
        $this->prixVend = $prixVend;

        return $this;
    }

    /**
     * Get prixVend
     *
     * @return float
     */
    public function getPrixVend()
    {
        return $this->prixVend;
    }

    /**
     * Set prixVendRev
     *
     * @param float $prixVendRev
     *
     * @return produits
     */
    public function setPrixVendRev($prixVendRev)
    {
        $this->prixVendRev = $prixVendRev;

        return $this;
    }

    /**
     * Get prixVendRev
     *
     * @return float
     */
    public function getPrixVendRev()
    {
        return $this->prixVendRev;
    }

    /**
     * Set vendu
     *
     * @param boolean $vendu
     *
     * @return produits
     */
    public function setVendu($vendu)
    {
        $this->vendu = $vendu;

        return $this;
    }

    /**
     * Get vendu
     *
     * @return bool
     */
    public function getVendu()
    {
        return $this->vendu;
    }
}

