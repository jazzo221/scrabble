<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scoresheet
 *
 * @ORM\Table(name="scoresheet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScoresheetRepository")
 */
class Scoresheet
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
     * @ORM\Column(name="word", type="string", length=255)
     */
    private $word;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var int
     *
     * @ORM\Column(name="turn", type="integer")
     */
    private $turn;

    /**
     * @var Game
     *
     * @ORM\OneToOne(targetEntity="Game", mappedBy="scoresheet")
     */
    private $game;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player;


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
     * Set word
     *
     * @param string $word
     *
     * @return Scoresheet
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return Scoresheet
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set turn
     *
     * @param integer $turn
     *
     * @return Scoresheet
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Set game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return Scoresheet
     */
    public function setGame(\AppBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set player
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return Scoresheet
     */
    public function setPlayer(\AppBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \AppBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
}
