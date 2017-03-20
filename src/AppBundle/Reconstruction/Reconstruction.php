<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Reconstruction;


use AppBundle\Entity\Game;
use AppBundle\Entity\Scoresheet;
use AppBundle\Entity\Turn;
use AppBundle\Model\Bag\Bag;
use AppBundle\Model\Board\Board;

class Reconstruction
{


    /**
     * @var Possibility
     */
    private $possibility;

    /**
     * @var Bag
     */
    private $bag;

    public function __construct()
    {

        $this->possibility = new Possibility();
        $this->possibility->setBoard(new Board());
        $zeroTurn = new Turn();
        $zeroTurn->setNumber(0);
        $this->possibility->setTurn($zeroTurn);
    }


    public function reconstruct(Game $game, Bag $bag){
        $scoresheet = $game->getScoresheet();
        $this->bag = $bag;

        if(!$scoresheet instanceof Scoresheet){
            throw new \BadMethodCallException("Game has to have scoresheet to reconstruct");
        }



        foreach ($scoresheet->getTurns() as $turn){
            $this->getPossibilities($turn);
        }

        return $this->possibility;
    }

    private function getPossibilities(Turn $turn){

        $possibilities = $this->possibility->getRootPossibilitiesForTurn($turn);

        //check if turn is first
        if($turn->getNumber() == 1){
            $word = $turn->getWord();
            $startTileRow = 7;

            $wordLength = strlen($word);
            for($i = 1; $i <= $wordLength; $i++){
                $column = $startTileRow - $wordLength + $i;

                $board = new Board();
                $bag = clone $this->bag;

                foreach (str_split($word) as $letter){
                    $bagLetter = $bag->getLetter($letter);
                    $board->placeLetter($bagLetter,$startTileRow,$column++);

                }

                $possibility = new Possibility();
                $possibility
                    ->setTurn($turn)
                    ->setBoard($board);
                ;

                $this->possibility->addPossibility($possibility);
            }

        }
    }

}