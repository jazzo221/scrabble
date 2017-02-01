<?php
namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class DoubleLetterBonus extends AbstractTile
{

    /**
     * @param Letter $letter
     * @param Word $word
     * @return int
     */
    public function getScore(Letter $letter, Word $word)
    {
        return $letter->getPoints()*2;
    }

    public function render()
    {
        return "<td class='tile double-letter-bonus'>2x Letter</td>";
    }
}