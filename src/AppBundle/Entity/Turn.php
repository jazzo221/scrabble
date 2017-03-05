<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Turn
 *
 * @ORM\Table(name="turn")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TurnRepository")
 */
class Turn
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
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

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
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn()
     */
    private $player;


    /**
     * @var Scoresheet
     *
     * @ORM\ManyToOne(targetEntity="Scoresheet", inversedBy="turns")
     * @ORM\JoinColumn()
     */
    private $scoresheet;


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
     * @return Turn
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
     * @return Turn
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
     * Set number
     *
     * @param integer $number
     *
     * @return Turn
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set player
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return Turn
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

    /**
     * Set scoresheet
     *
     * @param \AppBundle\Entity\Scoresheet $scoresheet
     *
     * @return Turn
     */
    public function setScoresheet(\AppBundle\Entity\Scoresheet $scoresheet = null)
    {
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
}
