<?php

namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class DoubleWordBonus extends AbstractTile
{

    /**
     * {@inheritdoc}
     */
    public function getScore(Letter $letter, Word $word)
    {
        return $word->getActualPoints()*3;
    }

    public function render()
    {
        $content = $this->hasLetter() ? $this->letter : "2x Word";
        return "<td class='tile double-word-bonus'>".$content."</td>";
    }
}