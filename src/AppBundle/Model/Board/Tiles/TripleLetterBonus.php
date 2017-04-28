<?php

namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class TripleLetterBonus extends AbstractTile
{

    /**
     * @param Letter $letter
     * @return int
     */
    public function getScore(Letter $letter)
    {
        return $letter->getPoints()*3;
    }

    /**
     * @return string
     */
    public function render()
    {
        $content = $this->hasLetter() ? $this->letter->render() : "3x Písmeno";
        return "<td class='tile triple-letter-bonus'>".$content."</td>";
    }
}