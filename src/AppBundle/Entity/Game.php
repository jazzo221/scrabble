<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Player", inversedBy="games")
     * @ORM\JoinTable()
     */
    private $players;

    /**
     * @var Scoresheet
     *
     * @ORM\OneToOne(targetEntity="Scoresheet", mappedBy="game", cascade={"persist"})
     */
    private $scoresheet;

    /**
     * @var LetterConfiguration
     *
     * @ORM\ManyToOne(targetEntity="LetterConfiguration", inversedBy="games")
     * @ORM\JoinColumn()
     */
    private $letterConfiguration;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
    }


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Game
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add player
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return Game
     */
    public function addPlayer(\AppBundle\Entity\Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param \AppBundle\Entity\Player $player
     */
    public function removePlayer(\AppBundle\Entity\Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }


    /**
     * Set scoresheet
     *
     * @param \AppBundle\Entity\Scoresheet $scoresheet
     *
     * @return Game
     */
    public function setScoresheet(\AppBundle\Entity\Scoresheet $scoresheet = null)
    {
        if($scoresheet)
            $scoresheet->setGame($this);
        $this->scoresheet = $scoresheet;

        return $this;
    }

    /**
     * Get scoresheet
     *
     * @return \AppBundle\Entity\Scoresheet
     */
    public function getScoresheet()
    {
        return $this->scoresheet;
    }

    /**
     * Set letterConfiguration
     *
     * @param \AppBundle\Entity\LetterConfiguration $letterConfiguration
     *
     * @return Game
     */
    public function setLetterConfiguration(\AppBundle\Entity\LetterConfiguration $letterConfiguration = null)
    {
        $this->letterConfiguration = $letterConfiguration;

        return $this;
    }

    /**
     * Get letterConfiguration
     *
     * @return \AppBundle\Entity\LetterConfiguration
     */
    public function getLetterConfiguration()
    {
        return $this->letterConfiguration;
    }
}
