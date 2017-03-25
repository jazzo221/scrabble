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
use AppBundle\Model\Word\Word;

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
     * @var Word
     */
    private $mainWord;

    /**
     * @var Word[]
     */
    private $createdWords;

    /**
     * @var int
     */
    private $points = 0;

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
     * Possibility constructor.
     * @param Turn $turn
     * @param Board $board
     * @param Bag $letterBag
     */
    public function __construct(Turn $turn, Board $board, Bag $letterBag)
    {
        $this->turn = $turn;
        $this->board = clone $board;
        $this->letterBag = clone $letterBag;
    }


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
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
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
    public function getRootPossibilitiesForTurn(Turn $turn, $possibilities = []){

        if($this->turn->getNumber() === $turn->getNumber() -1 && $this->isValid()){
//            var_dump($this);
            return [$this];
        }else{

            foreach ($this->getPossibilities() as $possibility){
                $sub = $possibility->getRootPossibilitiesForTurn($turn);
                $possibilities = array_merge($possibilities,$sub);
            }

            return $possibilities;
        }
    }

    /**
     * @return Word
     */
    public function getMainWord()
    {
        return $this->mainWord;
    }

    public function placeMainWord($word, $startRow, $startColumn, $horizontal)
    {
        $letters = [];

        $currRow = $startRow;
        $currColumn = $startColumn;
        foreach (preg_split('//u', $word, null, PREG_SPLIT_NO_EMPTY) as $char){
            $char = mb_strtoupper($char);
            $tile = $this->board->getTile($currRow,$currColumn);

            if($letter = $tile->getLetter()){
                //letter already on board
                if ($letter->getLetter() !== $char){
                    throw new \Exception('Letter on tile ('.$letter->getLetter().') is not same as expected character: '.$char);
                }

                $letters[] = $letter;

            }else{
                $letter = $this->letterBag->getLetter($char);

                $this->usedLetters[] = $letter;
                $tile->setLetter($letter);
                $letters[] = $letter;
                //check if new word was created
                if($this->board->isConnected($currRow,$currColumn)){
                    //if we placed word horizontally we could create word only vertically
                    $this->createdWords[] = $this->getCreatedWord($currRow,$currColumn,!$horizontal);
                };
            }

            if($horizontal){
                $currColumn++;
            }else{
                $currRow++;
            }
        }

        $this->mainWord = new Word($letters);
        $this->points += $this->mainWord->getActualPoints();
        foreach ($this->createdWords as $createdWord){
            $this->points += $createdWord->getCleanPoints();
        }

        if(count($this->usedLetters) == 7 ){
            //bonus for using all letters on hand
            $this->points += 50;
        }
        //todo check for other created words
    }

    /**
     * @return Word[]
     */
    public function getCreatedWords()
    {
        return $this->createdWords;
    }

    private function getCreatedWord($row, $column, $horizontal){
        // find start of this word first
        do {
            $tile = $this->getBoard()->getTile($row,$column);
            if($horizontal){
                $column--;
            }else{
                $row--;
            }

        }while ($tile->hasLetter());

        $letters = [];
        //get letters
        while($tile->hasLetter()){
            $letters[] = $tile->getLetter();

            if($horizontal){
                $column++;
            }else{
                $row++;
            }
            $tile = $this->getBoard()->getTile($row,$column);
        }

        return new Word($letters);
    }


    /**
     * @return bool
     */
    public function isValid()
    {
        if($this->getTurn()->getPoints() != $this->points){
            return false;
        }

        return true;
    }



}