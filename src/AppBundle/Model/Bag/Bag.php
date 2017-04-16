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

    function __clone()
    {
        $clones = [];

        foreach ($this->letters as $letter){
            $clones[] = clone $letter;
        }
        $this->letters = $clones;
    }


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

    /**
     * @param $char
     * @return Letter
     * @throws \Exception
     */
    public function getLetter($char){
        /** @var Letter $letter */
        foreach ($this->letters as $letter){
//            var_dump($letter)
            if(mb_stripos($char,$letter->getLetter()) !== false){
                $found = $letter;
                $letterCount = $found->getCount();
                if($letterCount === 0){
                    throw new \Exception("No more '".$char."' in bag");
                }

                $letter->setCount($letterCount - 1);
                return clone $found;
            }
        }

        throw new \Exception('Letter '.$char.' not found in bag');
    }


}