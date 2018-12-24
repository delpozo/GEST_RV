<?php

namespace AppBundle\Entity;

/**
 * appareil
 */
class appareil
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
    private $nom;

    /**
     * @var string
     */
    private $accessoir;

    /**
     * @var \DateTime
     */
    private $dateEntre;

    /**
     * @var array
     */
    private $probleme;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var array
     */
    private $pieceChanger;

    /**
     * @var float
     */
    private $prix;

    private $credit;

    /**
     * @var int
     */
    private $deponse;

    /**
     * @var client
     */
    private $client;

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
     * @return appareil
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
     * Set nom
     *
     * @param string $nom
     *
     * @return appareil
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set accessoir
     *
     * @param string $accessoir
     *
     * @return appareil
     */
    public function setAccessoir($accessoir)
    {
        $this->accessoir = $accessoir;

        return $this;
    }

    /**
     * Get accessoir
     *
     * @return string
     */
    public function getAccessoir()
    {
        return $this->accessoir;
    }

    /**
     * Set dateEntre
     *
     * @param \DateTime $dateEntre
     *
     * @return appareil
     */
    public function setDateEntre($dateEntre)
    {
        $this->dateEntre = $dateEntre;

        return $this;
    }

    /**
     * Get dateEntre
     *
     * @return \DateTime
     */
    public function getDateEntre()
    {
        return $this->dateEntre;
    }

    /**
     * Set probleme
     *
     * @param array $probleme
     *
     * @return appareil
     */
    public function setProbleme($probleme)
    {
        $this->probleme = $probleme;

        return $this;
    }

    /**
     * Get probleme
     *
     * @return array
     */
    public function getProbleme()
    {
        return $this->probleme;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return appareil
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set pieceChanger
     *
     * @param array $pieceChanger
     *
     * @return appareil
     */
    public function setPieceChanger($pieceChanger)
    {
        $this->pieceChanger = $pieceChanger;

        return $this;
    }

    /**
     * Get pieceChanger
     *
     * @return array
     */
    public function getPieceChanger()
    {
        return $this->pieceChanger;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return appareil
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
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
     * Set client
     *
     * @param \AppBundle\Entity\client $client
     *
     * @return produits
     */
    public function setClient(\AppBundle\Entity\client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add client
     *
     * @param \AppBundle\Entity\client $client
     *
     * @return appareil
     */
    public function addClient(\AppBundle\Entity\client $client)
    {
        $this->client[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \AppBundle\Entity\client $client
     */
    public function removeClient(\AppBundle\Entity\client $client)
    {
        $this->client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    
    public function __toString() {
        return $this->getNom();
    }
}

