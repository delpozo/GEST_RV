<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


class User extends BaseUser
{

    protected $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $numTel;

    /**
     * @var string
     */
    private $numFix;


    /**
     * @var string
     */
    private $adress;

    /**
     * @var float
     */
    private $deponse;

    /**
     * @var float
     */
    private $restPay;

    /**
     * @var float
     */
    private $credit;

    /**
     * @var float
     */
    private $clientAdmin;

    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set numTel
     *
     * @param string $numTel
     *
     * @return User
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set numFix
     *
     * @param string $numFix
     *
     * @return User
     */
    public function setNumFix($numFix)
    {
        $this->numFix = $numFix;

        return $this;
    }

    /**
     * Get numFix
     *
     * @return string
     */
    public function getNumFix()
    {
        return $this->numFix;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return User
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
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set deponse
     *
     * @param float $deponse
     *
     * @return User
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

    /**
     * Set restPay
     *
     * @param float $restPay
     *
     * @return User
     */
    public function setRestPay($restPay)
    {
        $this->restPay = $restPay;

        return $this;
    }

    /**
     * Get restPay
     *
     * @return float
     */
    public function getRestPay()
    {
        return $this->restPay;
    }

    /**
     * Set credit
     *
     * @param float $credit
     *
     * @return User
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
     * Set clientAdmin
     *
     * @param float $clientAdmin
     *
     * @return User
     */
    public function setClientAdmin($clientAdmin)
    {
        $this->clientAdmin = $clientAdmin;

        return $this;
    }

    /**
     * Get clientAdmin
     *
     * @return float
     */
    public function getClientAdmin()
    {
        return $this->clientAdmin;
    }

    private $vende;
    /**
     * Add vende
     *
     * @param \AppBundle\Entity\vende $vende
     *
     * @return produits
     */
    public function addVende(\AppBundle\Entity\vende $vende)
    {
        $this->vende[] = $vende;

        return $this;
    }

    /**
     * Remove vende
     *
     * @param \AppBundle\Entity\vende $vende
     */
    public function removeVende(\AppBundle\Entity\vende $vende)
    {
        $this->vende->removeElement($vende);
    }

    /**
     * Get vende
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVende()
    {
        return $this->vende;
    }


    public function __toString() {
        return $this->getNom()." ".$this->getPrenom();
    }
}
