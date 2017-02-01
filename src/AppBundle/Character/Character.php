<?php
/**
 * Created by PhpStorm.
 * User: Jeziorski
 * Date: 1. 2. 2017
 * Time: 12:02
 */

namespace AppBundle\Character;


class Character
{

    /**
     * @var integer
     */
    private $points;


    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }
}