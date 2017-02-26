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
     * @ORM\OneToMany(targetEntity="Scoresheet", mappedBy="game", cascade={"persist"})
     */
    private $scoresheets;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->scoresheets = new ArrayCollection();
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
     * Add scoresheet
     *
     * @param \AppBundle\Entity\Scoresheet $scoresheet
     *
     * @return Game
     */
    public function addScoresheet(\AppBundle\Entity\Scoresheet $scoresheet)
    {
        $scoresheet->setGame($this);
        $this->scoresheets[] = $scoresheet;

        return $this;
    }

    /**
     * Remove scoresheet
     *
     * @param \AppBundle\Entity\Scoresheet $scoresheet
     */
    public function removeScoresheet(\AppBundle\Entity\Scoresheet $scoresheet)
    {
        $this->scoresheets->removeElement($scoresheet);
    }

    /**
     * Get scoresheets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScoresheets()
    {
        return $this->scoresheets;
    }
}
