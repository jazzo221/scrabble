<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 1. 2. 2017
 * Time: 20:57
 */

namespace AppBundle\Model\Word;


use AppBundle\Entity\Letter;
use AppBundle\Model\Board\Tiles\AbstractWordBonus;

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
        $this->setLetters($letters);
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
        $this->computePoints();
    }

    /**
     * @return int
     */
    public function getCleanPoints()
    {
        return $this->cleanPoints;
    }

    /**
     * @return int
     */
    public function getActualPoints()
    {
        return $this->actualPoints;
    }

    private function computePoints()
    {

        foreach ($this->letters as $letter){
            $this->cleanPoints += $letter->getPoints();
            if(!$letter->getTile()->isUsedBonus()){
                $this->actualPoints += $letter->getTile()->getScore($letter);
            }else{
                $this->actualPoints += $letter->getPoints();
            }

        }

        foreach ($this->letters as $letter){
            $tile = $letter->getTile();
            if ($tile instanceof AbstractWordBonus && !$tile->isUsedBonus()){
                $this->actualPoints = $tile->getScoreMultiplied($this);
            }
        }


    }

    function __toString()
    {
        $string = '';
        foreach ($this->letters as $letter){
            $string .= $letter->getLetter();
        }

        return $string;
    }


}