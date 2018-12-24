<?php

namespace AppBundle\Entity;

/**
 * client
 */
class client
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $nompre;

    /**
     * @var string
     */
    private $adress;

    /**
     * @var int
     */
    private $credit;

    /**
     * @var int
     */
    private $deponse;

    /**
     * @var string
     */
    private $numtel;

    /**
     * @var appareil
     */
    private $appareil;
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
     * Set code
     *
     * @param string $code
     *
     * @return client
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nompre
     *
     * @param string $nompre
     *
     * @return client
     */
    public function setNompre($nompre)
    {
        $this->nompre = $nompre;

        return $this;
    }

    /**
     * Get nompre
     *
     * @return string
     */
    public function getNompre()
    {
        return $this->nompre;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return client
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set credit
     *
     * @param integer $credit
     *
     * @return client
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return int
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set deponse
     *
     * @param integer $deponse
     *
     * @return client
     */
    public function setDeponse($deponse)
    {
        $this->deponse = $deponse;

        return $this;
    }

    /**
     * Get deponse
     *
     * @return int
     */
    public function getDeponse()
    {
        return $this->deponse;
    }

    /**
     * Set numtel
     *
     * @param string $numtel
     *
     * @return client
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;

        return $this;
    }

    /**
     * Get numtel
     *
     * @return string
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * Add appareil
     *
     * @param \AppBundle\Entity\appareil $appareil
     *
     * @return fournisseurs
     */
    public function addAppareil(\AppBundle\Entity\appareil $appareil)
    {
        $this->appareil[] = $appareil;

        return $this;
    }

    /**
     * Remove appareil
     *
     * @param \AppBundle\Entity\appareil $appareil
     */
    public function removeAppareil(\AppBundle\Entity\appareil $appareil)
    {
        $this->appareil->removeElement($appareil);
    }

    /**
     * Get appareil
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppareil()
    {
        return $this->appareil;
    }

    public function __toString() {
        return $this->getNompre();
    }
}

