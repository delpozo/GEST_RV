<?php

namespace AppBundle\Entity;

/**
 * statfour
 */
class statfour
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idElem;

    /**
     * @var array
     */
    private $nbProduitNVend;

    /**
     * @var array
     */
    private $nbProduitVend;

    /**
     * @var array
     */
    private $listProduitVend;

    /**
     * @var array
     */
    private $listVend;

    /**
     * @var float
     */
    private $credit;

    /**
     * @var float
     */
    private $deponse;


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
     * Set idElem
     *
     * @param integer $idElem
     *
     * @return statfour
     */
    public function setIdElem($idElem)
    {
        $this->idElem = $idElem;

        return $this;
    }

    /**
     * Get idElem
     *
     * @return int
     */
    public function getIdElem()
    {
        return $this->idElem;
    }

    /**
     * Set setNbProduitNVend
     *
     * @param string $nbProduitNVend
     *
     * @return statfour
     */
    public function setNbProduitNVend($nbProduitNVend)
    {
        $this->nbProduitNVend = $nbProduitNVend;

        return $this;
    }

    /**
     * Get setNbProduitNVend
     *
     * @return string
     */
    public function getNbProduitNVend()
    {
        return $this->nbProduitNVend;
    }

    /**
     * Set info
     *
     * @param array $info
     *
     * @return statfour
     */
    public function setNbProduitVend($nbProduitVend)
    {
        $this->nbProduitVend = $nbProduitVend;

        return $this;
    }

    /**
     * Get info
     *
     * @return array
     */
    public function getNbProduitVend()
    {
        return $this->nbProduitVend;
    }

    /**
     * Set infoArray
     *
     * @param array $listProduitVend
     *
     * @return statfour
     */
    public function setListProduitVend($listProduitVend)
    {
        $this->listProduitVend = $listProduitVend;

        return $this;
    }

    /**
     * Get listProduitVend
     *
     * @return array
     */
    public function getListProduitVend()
    {
        return $this->listProduitVend;
    }

    /**
     * Set infoArray
     *
     * @param array $listProduitVend
     *
     * @return statfour
     */
    public function setListVend($listVend)
    {
        $this->listVend = $listVend;

        return $this;
    }

    /**
     * Get listProduitVend
     *
     * @return array
     */
    public function getListVend()
    {
        return $this->listVend;
    }

    /**
     * Set credit
     *
     * @param float $credit
     *
     * @return statfour
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return float
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set deponse
     *
     * @param float $deponse
     *
     * @return statfour
     */
    public function setDeponse($deponse)
    {
        $this->deponse = $deponse;

        return $this;
    }

    /**
     * Get deponse
     *
     * @return float
     */
    public function getDeponse()
    {
        return $this->deponse;
    }
}

