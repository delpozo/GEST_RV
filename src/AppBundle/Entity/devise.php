<?php

namespace AppBundle\Entity;

/**
 * devise
 */
class devise
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
    private $symbole;

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
     * @return devise
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
     * Set symbol
     *
     * @param string $symbole
     *
     * @return devise
     */
    public function setSymbole($symbole)
    {
        $this->symbole = $symbole;

        return $this;
    }

    /**
     * Get symbole
     *
     * @return string
     */
    public function getSymbole()
    {
        return $this->symbole;
    }
}
