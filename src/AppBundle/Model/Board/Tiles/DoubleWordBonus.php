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
        return "<td class='tile double-word-bonus'>2x Word</td>";
    }
}