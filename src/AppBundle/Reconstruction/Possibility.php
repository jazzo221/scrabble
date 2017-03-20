<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Reconstruction;


use AppBundle\Entity\Letter;
use AppBundle\Entity\Turn;
use AppBundle\Model\Bag\Bag;
use AppBundle\Model\Board\Board;

class Possibility
{

    /**
     * @var Turn
     */
    private $turn;

    /**
     * @var Board
     */
    private $board;

    /**
     * @var Letter[]
     */
    private $usedLetters;

    /**
     * @var Bag
     */
    private $letterBag;

    /**
     * @var Possibility
     */
    private $parent;

    /**
     * @var Possibility[]
     */
    private $possibilities = [];

    /**
     * @return Turn
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @param Turn $turn
     * @return Possibility
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;
        return $this;
    }

    /**
     * @return Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @param Board $board
     * @return Possibility
     */
    public function setBoard($board)
    {
        $this->board = $board;
        return $this;
    }

    /**
     * @return Letter[]
     */
    public function getUsedLetters()
    {
        return $this->usedLetters;
    }

    /**
     * @param Letter[] $usedLetters
     * @return Possibility
     */
    public function setUsedLetters($usedLetters)
    {
        $this->usedLetters = $usedLetters;
        return $this;
    }

    /**
     * @return Bag
     */
    public function getLetterBag()
    {
        return $this->letterBag;
    }

    /**
     * @param Bag $letterBag
     * @return Possibility
     */
    public function setLetterBag($letterBag)
    {
        $this->letterBag = $letterBag;
        return $this;
    }

    /**
     * @return Possibility
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Possibility $parent
     * @return Possibility
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return Possibility[]
     */
    public function getPossibilities()
    {
        return $this->possibilities;
    }

    /**
     * @param Possibility[] $possibilities
     * @return Possibility
     */
    public function setPossibilities($possibilities)
    {
        $this->possibilities = $possibilities;
        return $this;
    }

    /**
     * @param $possibility
     * @return $this
     */
    public function addPossibility(Possibility $possibility){
        $this->possibilities[] = $possibility;
        return $this;
    }

    /**
     * @param Turn $turn
     * @return Possibility[]
     */
    public function getRootPossibilitiesForTurn(Turn $turn){

        if($this->turn->getNumber() === $turn->getNumber() -1){
            return $this->getPossibilities();
        }else{
            $possibilities = [];
            foreach ($this->getPossibilities() as $possibility){
                $sub = $possibility->getRootPossibilitiesForTurn($turn);
                array_merge($sub);
            }

            return $possibilities;
        }
    }

    public function isValid()
    {
        //todo validate
    }



}