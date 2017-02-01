<?php
/**
 * Created by PhpStorm.
 * User: Jeziorski
 * Date: 1. 2. 2017
 * Time: 11:29
 */

namespace AppBundle\Board\Tiles;


use AppBundle\Character\Character;

abstract class Tile
{

    /**
     * @param Character $character
     * @param Character[] $word
     * @return int
     */
    public abstract function getScore(Character $character, array $word);
}