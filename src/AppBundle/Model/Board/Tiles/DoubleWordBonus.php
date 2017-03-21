<?php

namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class DoubleWordBonus extends AbstractWordBonus
{


    public function render()
    {
        $content = $this->hasLetter() ? $this->letter->render() : "2x Word";
        return "<td class='tile double-word-bonus'>".$content."</td>";
    }

    function getScoreMultiplied(Word $word)
    {
        return $word->getActualPoints()*2;
    }
}