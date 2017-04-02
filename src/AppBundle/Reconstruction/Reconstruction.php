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
    /**
     * @var AvailableTilesGenerator
     */
    private $availableTilesGenerator;

    /**
     * Reconstruction constructor.
     * @param AvailableTilesGenerator $availableTilesGenerator
     */
    public function __construct(AvailableTilesGenerator $availableTilesGenerator)
    {
        $this->availableTilesGenerator = $availableTilesGenerator;
    }


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
        $word = $turn->getWord();

        //check if turn is first
        if($turn->getNumber() == 1){
            $startTileRow = 7;

            $wordLength = mb_strlen($word);
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
                if(mb_strlen($word) > 0){
                    $availableTiles = $this->availableTilesGenerator->generate($possibility->getBoard(),$word);
                    foreach ($availableTiles as $availableTile){

                        $subPossibility = new Possibility($turn,$possibility->getBoard(),$possibility->getLetterBag());
                        $subPossibility->placeMainWord($word,$availableTile->getRow(),$availableTile->getColumn(),$availableTile->isHorizontal());
                        if($subPossibility->isValid())
                            $possibility->addPossibility($subPossibility);
                    }
                }else{
                    $subPossibility = new Possibility($turn,$possibility->getBoard(),$possibility->getLetterBag());
                    $subPossibility->placeMainWord($word,0,0,true);
                    if($subPossibility->isValid())
                        $possibility->addPossibility($subPossibility);
                }

                if(count($possibility->getPossibilities()) === 0){
                    $possibility->removeFromParent();
                }
            }
        }
    }

}