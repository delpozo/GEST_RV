<?php

namespace AppBundle\Entity;

/**
 * proposition_fournisseurs
 */
class proposition_fournisseurs
{
    /**
     * @var int
     */
    private $id;

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
    private $text;


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
     * Set dateAc
     *
     * @param \DateTime $dateAc
     *
     * @return proposition_fournisseurs
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
     * @return proposition_fournisseurs
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
     * Set text
     *
     * @param string $text
     *
     * @return proposition_fournisseurs
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}
