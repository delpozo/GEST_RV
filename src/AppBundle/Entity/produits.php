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
    private $nomFour;

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
     * @var date
     */
    private $date;

    /**
     * Get id
     *
     * @return int
     */

    /**
     * @var integer
     */
    private $idType;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vende;


    /**
     * @var \AppBundle\Entity\fournisseurs
     */
    private $fournisseurs;

    /**
     * @var \AppBundle\Entity\type_produit
     */
    private $type_produit;

    /**
     * 
     */
    private $abonnement;

    /**
     * 
     */
    private $prixRevend;

    /**
     * Constructor
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomFour
     *
     * @param integer $nomFour
     *
     * @return produits
     */
    public function setNomFour($nomFour)
    {
        $this->nomFour = $nomFour;

        return $this;
    }

    /**
     * Get nomFour
     *
     * @return int
     */
    public function getNomFour()
    {
        return $this->nomFour;
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

    public function __construct()
    {
        $this->vende = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set idType
     *
     * @param integer $idType
     *
     * @return produits
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return integer
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return produits
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
     * Set abonnement
     *
     * @param string $abonnement
     *
     * @return produits
     */
    public function setAbonnement($abonnement)
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    /**
     * Get abonnement
     *
     * @return string
     */
    public function getAbonnement()
    {
        return $this->abonnement;
    }

    /**
     * Set prixRevend
     *
     * @param string $prixRevend
     *
     * @return produits
     */
    public function setPrixRevend($prixRevend)
    {
        $this->prixRevend = $prixRevend;

        return $this;
    }

    /**
     * Get prixRevend
     *
     * @return string
     */
    public function getPrixRevend()
    {
        return $this->prixRevend;
    }


    /**
     * Set code
     *
     * @param string $nom
     *
     * @return produits
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

    /**
     * Set fournisseurs
     *
     * @param \AppBundle\Entity\fournisseurs $fournisseurs
     *
     * @return produits
     */
    public function setFournisseurs(\AppBundle\Entity\fournisseurs $fournisseurs = null)
    {
        $this->fournisseurs = $fournisseurs;

        return $this;
    }

    /**
     * Get fournisseurs
     *
     * @return \AppBundle\Entity\fournisseurs
     */
    public function getFournisseurs()
    {
        return $this->fournisseurs;
    }

    /**
     * Set typeProduit
     *
     * @param \AppBundle\Entity\type_produit $typeProduit
     *
     * @return produits
     */
    public function setTypeProduit(\AppBundle\Entity\type_produit $typeProduit = null)
    {
        $this->type_produit = $typeProduit;

        return $this;
    }

    /**
     * Get typeProduit
     *
     * @return \AppBundle\Entity\type_produit
     */
    public function getTypeProduit()
    {
        return $this->type_produit;
    }

    public function __toString() {
        return $this->getNom();
    }
}
