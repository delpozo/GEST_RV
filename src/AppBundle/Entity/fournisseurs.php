<?php

namespace AppBundle\Entity;

/**
 * fournisseurs
 */
class fournisseurs
{
    /**
     * @var int
     */
    private $id;

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
    private $email;

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
    private $credit;

    /**
     * @var date
     */
    private $date;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return fournisseurs
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
     * @return fournisseurs
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
     * @return fournisseurs
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
     * @return fournisseurs
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
     * Set email
     *
     * @param string $email
     *
     * @return fournisseurs
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
     * Set adress
     *
     * @param string $adress
     *
     * @return fournisseurs
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
     * Get deponse
     *
     * @return int
     */
    public function getDeponse()
    {
        return $this->deponse;
    }

    /**
     * Set deponse
     *
     * @param integer $deponse
     *
     * @return fournisseurs
     */
    public function setDeponse($deponse)
    {
        $this->deponse = $deponse;

        return $this;
    }
    /**
     * Get credit
     *
     * @return integer
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set credit
     *
     * @param integer $credit
     *
     * @return fournisseurs
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $produits;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produit
     *
     * @param \AppBundle\Entity\produits $produit
     *
     * @return fournisseurs
     */
    public function addProduit(\AppBundle\Entity\produits $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AppBundle\Entity\produits $produit
     */
    public function removeProduit(\AppBundle\Entity\produits $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }
    public function __toString() {
        return $this->getNom() ." ".$this->getPrenom();
    }
}
