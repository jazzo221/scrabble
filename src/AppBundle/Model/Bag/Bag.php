<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Model\Bag;


use AppBundle\Entity\Letter;

class Bag
{

    /**
     * @var Letter[]
     */
    private $letters;

    /**
     * @return Letter[]
     */
    public function getLetters()
    {
        return $this->letters;
    }

    /**
     * @param Letter[] $letters
     */
    public function setLetters($letters)
    {
        $this->letters = $letters;
    }


}