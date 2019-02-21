<?php

namespace Abonnement\RevendeurBundle\Entity;

/**
 * Revendeur
 */
class Revendeur
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
     * @var float
     */
    private $prixAchat;

    /**
     * @var \DateTime
     */
    private $dateAc;

    /**
     * @var \DateTime
     */
    private $dateEx;

    /**
     * @var bool 
     */
    private $credit;

    /**
     * @var float 
     */
    private $restPay;

    /**
     * @var float 
     */
    private $deponse;

    /**
     * @var date
     */
    private $date;

    /**
     * @var date
     */
    private $abonner;

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
     * @return Revendeur
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
     * Get prixAchat
     *
     * @return float
     */
    public function getprixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set dateAc
     *
     * @param \DateTime $dateAc
     *
     * @return vende
     */
    public function setprixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Set dateAc
     *
     * @param \DateTime $dateAc
     *
     * @return vende
     */
    public function setDateAc($dateAc)
    {
        $this->dateAc = $dateAc;

        return $this;
    }

    /**
     * Get dateAc
     *
     * @return \DateTime
     */
    public function getDateAc()
    {
        return $this->dateAc;
    }

    /**
     * Set dateEx
     *
     * @param \DateTime $dateEx
     *
     * @return vende
     */
    public function setDateEx($dateEx)
    {
        $this->dateEx = $dateEx;

        return $this;
    }

    /**
     * Get dateEx
     *
     * @return \DateTime
     */
    public function getDateEx()
    {
        return $this->dateEx;
    }
    /**
     * Set credit
     *
     * @param boolean $credit
     *
     * @return vende
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
     * Set date
     *
     * @param date $date
     *
     * @return produits
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get vendu
     *
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }
    private $User;

    /**
     * Get id
     *
     * @return int
     */
    public function getAbonner()
    {
        return $this->abonner;
    }
    /**
     * Set abonner
     *
     * @param date $abonner
     *
     * @return produits
     */
    public function setAbonner($abonner)
    {
        $this->abonner = $abonner;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user  = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return vende
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }
    /**
     * Set User
     *
     * @param \AppBundle\Entity\User $User
     *
     * @return vende
     */
    public function setUser(\AppBundle\Entity\User $User = null)
    {
        $this->User = $User;

        return $this;
    }

    /**
     * Get User
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }

    private $produits;

    public function getProduits()
    {
        return $this->produits;
    }
    /**
     * Add produits
     *
     * @param \AppBundle\Entity\produits $produits
     *
     * @return vende
     */
    public function addProduits(\AppBundle\Entity\produits $produits)
    {
        $this->produits[] = $produits;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\$roduits $produits
     */
    public function removeProduits(\AppBundle\Entity\produits $produits)
    {
        $this->produits->removeElement($produits);
    }
    /**
     * Set produits
     *
     * @param \AppBundle\Entity\produits $produits
     *
     * @return vende
     */
    public function setProduits(\AppBundle\Entity\produits $produits)
    {
        $this->produits = $produits;

        return $this;
    }
    public function __toString() {
        return $this->getCode();
    }
}

