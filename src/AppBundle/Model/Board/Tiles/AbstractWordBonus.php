<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\Word\Word;

abstract class AbstractWordBonus extends AbstractTile
{
    public function getScore(Letter $letter)
    {
        return $letter->getPoints();
    }

    abstract function getScoreMultiplied(Word $word);


}