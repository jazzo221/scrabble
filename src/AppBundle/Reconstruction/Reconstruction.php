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



    public function reconstruct(Game $game, Bag $bag){
        $scoresheet = $game->getScoresheet();
        $this->bag = $bag;
        $zeroTurn = new Turn();
        $zeroTurn
            ->setPoints(0)
            ->setNumber(0);
        $this->possibility = new Possibility($zeroTurn,new Board(),$bag);

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
                $possibility = new Possibility($turn,$board,$bag);

                $possibility->placeMainWord($word,$startTileRow,$column,true);
                $this->possibility->addPossibility($possibility);
            }

        }else{
            foreach ($possibilities as $possibility){
                $availableTiles = $possibility->getBoard()->getAvailableTiles();
                foreach ($availableTiles as $availableTile){
                    $word = $turn->getWord();
                    $wordLength = strlen($word);

                    $subPossibility = Possibility::createFromParent($possibility);
                    $subPossibility->placeMainWord($word,$availableTile->getRow(),$availableTile->getColumn(),true);
                    $subPossibility->placeMainWord($word,$availableTile->getRow(),$availableTile->getColumn(),false);
                }
            }
        }
    }

}