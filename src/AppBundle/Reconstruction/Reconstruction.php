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


    /**
     * Performs reconstruction of provided Game.
     *
     * @param Game $game The game to reconstruct
     * @return Possibility root node for possibility tree
     */
    public function reconstruct(Game $game){
        $scoresheet = $game->getScoresheet();
        if(!$scoresheet instanceof Scoresheet){
            throw new \BadMethodCallException("Game has to have scoresheet to reconstruct");
        }

        $bag = new Bag();
        $bag->setLetters($game->getLetterConfiguration()->getLetters());
        $this->bag = $bag;
        $zeroTurn = new Turn();
        $zeroTurn
            ->setPoints(0)
            ->setNumber(0);
        $this->possibility = new Possibility($zeroTurn,new Board(),$bag);

        foreach ($scoresheet->getTurns() as $turn){
            $this->getPossibilities($turn);
        }

        return $this->possibility;
    }

    /**
     * Main method witch generates new possibilities for our tree
     *
     * @param Turn $turn
     */
    private function getPossibilities(Turn $turn){

        $possibilities = $this->possibility->getRootPossibilitiesForTurn($turn);
        $word = $turn->getWord();

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
                $this->placeEmptyWord($turn,$possibility);
            }

            if(count($possibility->getPossibilities()) === 0){
                $possibility->removeFromParent();
            }
        }
    }

    /**
     * Adds empty word possibility to node
     *
     * @param Turn $turn
     * @param Possibility $possibility
     */
    private function placeEmptyWord(Turn $turn, Possibility $possibility){
        $subPossibility = new Possibility($turn,$possibility->getBoard(),$possibility->getLetterBag());
        $possibility->addPossibility($subPossibility);
    }

}