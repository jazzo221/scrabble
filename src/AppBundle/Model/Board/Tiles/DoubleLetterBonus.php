<?php
namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class DoubleLetterBonus extends AbstractTile
{

    /**
     * @param Letter $letter
     * @return int
     */
    public function getScore(Letter $letter)
    {
        return $letter->getPoints()*2;
    }

    public function render()
    {
        $content = $this->hasLetter() ? $this->letter->render() : "2x Písmeno";

        return "<td class='tile double-letter-bonus'>".$content."</td>";
    }
}