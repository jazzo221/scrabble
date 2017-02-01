<?php

namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class TripleLetterBonus extends AbstractTile
{

    /**
     * @param Letter $letter
     * @param Word $word
     * @return int
     */
    public function getScore(Letter $letter, Word $word)
    {
        return $letter->getPoints()*3;
    }

    /**
     * @return string
     */
    public function render()
    {
        return "<td class='tile triple-letter-bonus'>3x Letter</td>";
    }
}