<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Reconstruction;


use AppBundle\Entity\Game;
use AppBundle\Entity\Scoresheet;
use AppBundle\Model\Bag\Bag;

class Reconstruction
{

    public function __construct()
    {

    }


    public function reconstruct(Game $game, Bag $bag){
        $scoresheet = $game->getScoresheet();

        if(!$scoresheet instanceof Scoresheet){
            throw new \BadMethodCallException("Game has to have scoresheet to reconstruct");
        }


    }

}