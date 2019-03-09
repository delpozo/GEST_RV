<?php

namespace AppBundle\Entity;

/**
 * vende
 */
class vende
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var float
     */
    private $prixVend;

    /**
     * @var \DateTime
     */
    private $dateAc;

    /**
     * @var \DateTime
     */
    private $dateEx;

    /**
     * @var string
     */
    private $nompreCli;

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
     * @var string
     */
    private $email;
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
     * Set prixVend
     *
     * @param float $prixVend
     *
     * @return vende
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
     * Set nompreCli
     *
     * @param string $nompreCli
     *
     * @return vende
     */
    public function setNompreCli($nompreCli)
    {
        $this->nompreCli = $nompreCli;

        return $this;
    }

    /**
     * Get nompreCli
     *
     * @return string
     */
    public function getNompreCli()
    {
        return $this->nompreCli;
    }

    /**
     * Set numTel
     *
     * @param string $numTel
     *
     * @return vende
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
     * @return vende
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
     * @return vende
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
     * Set email
     *
     * @param string $email
     *
     * @return vende
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
    public function __toString()
    {
        return $this->getNompreCli() . '';
    }
}