<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 1. 2. 2017
 * Time: 20:57
 */

namespace AppBundle\Model\Word;


use AppBundle\Entity\Letter;

class Word
{

    /**
     * @var Letter[]
     */
    private $letters;

    private $cleanPoints = 0;

    private $actualPoints = 0;

    /**
     * Word constructor.
     * @param Letter[] $letters
     */
    public function __construct(array $letters)
    {
        $this->letters = $letters;

        $points = 0;
        foreach ($letters as $letter){
            $points += $letter->getPoints();
        }

        $this->setCleanPoints($points);
    }

    /**
     * @return Letter[]
     */
    public function getLetters()
    {
        return $this->letters;
    }

    /**
     * @param Letter[] $letters
     */
    public function setLetters($letters)
    {
        $this->letters = $letters;
    }

    /**
     * @return int
     */
    public function getCleanPoints()
    {
        return $this->cleanPoints;
    }

    /**
     * @param int $cleanPoints
     */
    public function setCleanPoints($cleanPoints)
    {
        $this->cleanPoints = $cleanPoints;
        $this->actualPoints = $cleanPoints;
    }

    /**
     * @return int
     */
    public function getActualPoints()
    {
        return $this->actualPoints;
    }

    /**
     * @param int $actualPoints
     */
    public function setActualPoints($actualPoints)
    {
        $this->actualPoints = $actualPoints;
    }




}