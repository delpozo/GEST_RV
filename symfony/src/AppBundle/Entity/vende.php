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
    private $id;

    /**
     * @var string
     */
    private $typeVend;

    /**
     * @var int
     */
    private $idProRev;

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
    private $nomCli;

    /**
     * @var string
     */
    private $prenomCli;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $numTel;

    /**
     * @var string
     */
    private $numFix;


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
     * Set typeVend
     *
     * @param string $typeVend
     *
     * @return vende
     */
    public function setTypeVend($typeVend)
    {
        $this->typeVend = $typeVend;

        return $this;
    }

    /**
     * Get typeVend
     *
     * @return string
     */
    public function getTypeVend()
    {
        return $this->typeVend;
    }

    /**
     * Set idProRev
     *
     * @param integer $idProRev
     *
     * @return vende
     */
    public function setIdProRev($idProRev)
    {
        $this->idProRev = $idProRev;

        return $this;
    }

    /**
     * Get idProRev
     *
     * @return int
     */
    public function getIdProRev()
    {
        return $this->idProRev;
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
     * Set nomCli
     *
     * @param string $nomCli
     *
     * @return vende
     */
    public function setNomCli($nomCli)
    {
        $this->nomCli = $nomCli;

        return $this;
    }

    /**
     * Get nomCli
     *
     * @return string
     */
    public function getNomCli()
    {
        return $this->nomCli;
    }

    /**
     * Set prenomCli
     *
     * @param string $prenomCli
     *
     * @return vende
     */
    public function setPrenomCli($prenomCli)
    {
        $this->prenomCli = $prenomCli;

        return $this;
    }

    /**
     * Get prenomCli
     *
     * @return string
     */
    public function getPrenomCli()
    {
        return $this->prenomCli;
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
}

