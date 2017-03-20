<?php

namespace AppBundle\Model\Board\Tiles;

use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class TripleWordBonus extends AbstractTile
{

    /**
     * {@inheritdoc}
     */
    public function getScore(Letter $letter, Word $word)
    {
        return $word->getActualPoints()*3;
    }

    /**
     * @return string
     */
    public function render()
    {
        $content = $this->hasLetter() ? $this->letter : "3x Word";
        return "<td class='tile triple-word-bonus'>".$content."</td>";
    }
}