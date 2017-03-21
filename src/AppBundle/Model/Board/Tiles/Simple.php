<?php

namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

class Simple extends AbstractTile
{

    /**
     * @param Letter $letter
     * @return int
     */
    public function getScore(Letter $letter)
    {
        return $letter->getPoints();
    }

    /**
     * @return string
     */
    public function render()
    {
        $content = !is_null($this->letter) ? $this->letter->render() : null;
        return "<td class='tile simple'>".$content."</td>";
    }
}