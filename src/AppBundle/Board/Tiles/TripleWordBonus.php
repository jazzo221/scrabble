<?php
/**
 * Created by PhpStorm.
 * User: Jeziorski
 * Date: 1. 2. 2017
 * Time: 12:01
 */

namespace AppBundle\Board\Tiles;


use AppBundle\Character\Character;

class TripleWordBonus extends Tile
{

    /**
     * {@inheritdoc}
     */
    public function getScore(Character $character, array $word)
    {
        $score = 0;

        /** @var Character $char */
        foreach($word as $char){
            $score += $char->getPoints();
        }

        return $score*3;
    }
}