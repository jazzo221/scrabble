<?php

namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class Simple extends AbstractTile
{

    /**
     * @param Letter $letter
     * @param Word $word
     * @return int
     */
    public function getScore(Letter $letter, Word $word)
    {
        return $letter->getPoints();
    }

    /**
     * @return string
     */
    public function render()
    {
        return "<td class='tile simple'>".$this->letter."</td>";
    }
}