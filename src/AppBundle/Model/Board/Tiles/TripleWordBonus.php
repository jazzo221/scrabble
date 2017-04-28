<?php

namespace AppBundle\Model\Board\Tiles;

use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class TripleWordBonus extends AbstractWordBonus
{


    /**
     * @return string
     */
    public function render()
    {
        $content = $this->hasLetter() ? $this->letter->render() : "3x Slovo";
        return "<td class='tile triple-word-bonus'>".$content."</td>";
    }

    function getScoreMultiplied(Word $word)
    {
        return $word->getActualPoints()*3;
    }
}