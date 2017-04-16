<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * LetterConfiguration
 *
 * @ORM\Table(name="letter_configuration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LetterConfigurationRepository")
 */
class LetterConfiguration
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Letter", mappedBy="letterConfiguration", ,cascade={"persist"})
     */
    private $letters;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Game", mappedBy="letterConfiguration")
     */
    private $games;


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
     * Set name
     *
     * @param string $name
     *
     * @return LetterConfiguration
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->letters = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add letter
     *
     * @param \AppBundle\Entity\Letter $letter
     *
     * @return LetterConfiguration
     */
    public function addLetter(\AppBundle\Entity\Letter $letter)
    {
        $letter->setLetterConfiguration($this);
        $this->letters[] = $letter;

        return $this;
    }

    /**
     * Remove letter
     *
     * @param \AppBundle\Entity\Letter $letter
     */
    public function removeLetter(\AppBundle\Entity\Letter $letter)
    {
        $this->letters->removeElement($letter);
    }

    /**
     * Get letters
     *
     * @return \Doctrine\Common\Collections\Collection|Letter[]
     */
    public function getLetters()
    {
        return $this->letters;
    }

    /**
     * Add game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return LetterConfiguration
     */
    public function addGame(\AppBundle\Entity\Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \AppBundle\Entity\Game $game
     */
    public function removeGame(\AppBundle\Entity\Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
}
