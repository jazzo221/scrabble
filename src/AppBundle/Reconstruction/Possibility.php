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

use JMS\Serializer\Annotation as JMS;

/**
 * Class Possibility
 * @package AppBundle\Reconstruction
 *
 */
class Possibility
{

    /**
     * @JMS\Exclude
     *
     * @var Turn
     */
    private $turn;

    /**
     * @var Board
     */
    private $board;

    /**
     * @JMS\Exclude
     *
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
    private $createdWords = [];

    /**
     * @var int
     */
    private $points = 0;

    /**
     * @JMS\Exclude
     *
     * @var Bag
     */
    private $letterBag;

    /**
     * @JMS\Exclude
     *
     * @var Possibility
     */
    private $parent;

    /**
     * @var Possibility[]
     *
     * @JMS\SerializedName("children")
     */
    private $possibilities = [];

    /**
     * @var array
     */
    private $errors = [];

    private $valid;


    /**
     * For Treant
     *
     * @JMS\Accessor(getter="getText")
     *
     * @var string
     */
    private $text;

    public function getText()
    {
        return [
            'name'=> "Ťah ".$this->turn->getNumber()
        ];
    }

    /**
     * For Treant
     *
     * @JMS\Accessor(getter="getInnerHTML")
     * @JMS\SerializedName("innerHTML")
     *
     * @var string
     */
    private $innerHTML;

    public function getInnerHtml()
    {
        return '#possibility-'.$this->getObjectHash();
    }


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
        $possibility->setParent($this);
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
                try{
                    if($this->turn->isBlank() && $this->turn->getBlankChar() === $char){
                        $letter = $this->letterBag->getLetter('*');
                        $letter->setLetter($char);
                    }else{
                        $letter = $this->letterBag->getLetter($char);
                    }
                } catch (\Exception $e){
                    $this->errors[] = $e->getMessage();
                    break;
                }



                $this->usedLetters[] = $letter;
                $tile->setLetter($letter);
                $letters[] = $letter;
                //check if new word was created
                $createdWord = $this->getCreatedWord($currRow,$currColumn,!$horizontal);
                if(!is_null($createdWord)){
                    //if we placed word horizontally we could create word only vertically
                    $this->createdWords[] = $createdWord;
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
            $this->points += $createdWord->getActualPoints();
        }
        if(count($this->usedLetters) == 7 ){
            //bonus for using all letters on hand
            $this->points += 50;
        }

        foreach ($this->mainWord->getLetters() as $letter){
            $letter->getTile()->setUsedBonus(true);
        }

        foreach ($this->createdWords as $createdWord){
            foreach ($createdWord->getLetters() as $letter){
                $letter->getTile()->setUsedBonus(true);
            }
        }



        if($this->getTurn()->getPoints() != $this->points){
            $this->errors[] = 'Zlý počet bodov';
        }
    }

    /**
     * @return Word[]
     */
    public function getCreatedWords()
    {
        return $this->createdWords;
    }

    private function getCreatedWord($row, $column, $horizontal){

        if(
            !((
                !$horizontal && (
                    ($row + 1 < 15 && $this->board->getTile($row+1,$column)->hasLetter()) ||
                    ($row - 1 >= 0 && $this->board->getTile($row-1,$column)->hasLetter())
                )
            ) ||
            (
                $horizontal && (
                    ($column + 1 < 15 && $this->board->getTile($row,$column+1)->hasLetter()) ||
                    ($column - 1 >= 0 && $this->board->getTile($row,$column-1)->hasLetter())
                )
            ))
        ){
            return null;
        }

        while ( $column >= 0 && $row >= 0 && $this->board->getTile($row,$column)->hasLetter() ){
            $horizontal ? $column-- : $row--;
        }

        $letters = [];

        do{
            $horizontal ? $column++ : $row++;
            $tile = $this->board->getTile($row,$column);
            if($tile->hasLetter())
                $letters[] = $tile->getLetter();
        }while($tile->hasLetter() && $column < 14 && $row < 14);

        if(count($letters) > 1){
            return new Word($letters);
        }else{
            return null;
        }
    }


    /**
     * @return bool
     */
    public function isValid()
    {

        if(count($this->errors) > 0)
        {
            return false;
        }

        return true;
    }


    public function getObjectHash(){
        return spl_object_hash($this);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function removeFromParent($recursive = true)
    {
        if($this->parent){
            $this->parent->remove($this,$recursive);
        }
    }

    private function remove(Possibility $possibility, $recursive = true)
    {
        foreach ($this->possibilities as $key => $child){
            if($possibility->getObjectHash() == $child->getObjectHash()){
                array_splice($this->possibilities, $key, 1);
            }
        }

        if ($recursive && count($this->possibilities) === 0){
            $this->removeFromParent();
        }
    }


}