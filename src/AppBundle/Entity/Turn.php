<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="word", type="string", length=255, nullable=true)
     */
    private $word = null;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blank", type="boolean", options={"default":false})
     */
    private $blank = false;

    /**
     * @var string
     *
     * @ORM\Column(name="blank_char", type="string", length=1, nullable=true)
     *
     * @Assert\Length(
     *      min = 1,
     *      max = 1
     * )
     *
     */
    private $blankChar;

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

    /**
     * Set blank
     *
     * @param boolean $blank
     *
     * @return Turn
     */
    public function setBlank($blank)
    {
        $this->blank = $blank;

        return $this;
    }

    /**
     * Get blank
     *
     * @return boolean
     */
    public function isBlank()
    {
        return $this->blank;
    }

    /**
     * Set blakChar
     *
     * @param string $blankChar
     *
     * @return Turn
     */
    public function setBlankChar($blankChar)
    {
        $this->blankChar = $blankChar;

        return $this;
    }

    /**
     * Get blankChar
     *
     * @return string
     */
    public function getBlankChar()
    {
        return $this->blankChar;
    }
}
