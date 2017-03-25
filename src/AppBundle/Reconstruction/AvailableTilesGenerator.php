<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Reconstruction;


use AppBundle\Model\Board\Board;
use AppBundle\Model\Board\Tiles\AbstractTile;

class AvailableTilesGenerator
{

    /**
     * @var AvailableTile[]
     */
    private $availableTiles;

    /**
     * @var Board
     */
    private $board;

    /**
     * @param Board $board
     * @param $word
     * @return AvailableTile[]
     */
    public function generate(Board $board, $word){
        $this->availableTiles = [];
        $this->board = $board;
        $wordArray = preg_split('//u', $word, null, PREG_SPLIT_NO_EMPTY);

        for($row = 0; $row < 15; $row++){
            for($column = 0; $column < 15; $column++){
                //first return tiles where whole new word can be created
//                $this->generateTilesForFullWord($word, $row, $column);
                $this->generateTilesForPosition($wordArray,$row,$column);
            }
        }
//
//        var_dump($wordArray);
//        var_dump($this->availableTiles);

        return $this->availableTiles;

    }


    private function generateTilesForPosition( array $wordArray, $row, $column){
        $wordLength = count($wordArray);

        if($wordLength + $row < 15
            && !$this->board->getTile($wordLength+$row,$column)->hasLetter()
            && ( $row -1 < 0 || !$this->board->getTile($row-1,$column)->hasLetter())
        ){
            $isConnected = false;
            $matchesLetter = true;
            for ($currentRow = $row; $currentRow < $row+$wordLength; $currentRow++){
                if(!$isConnected){
                    $isConnected = $this->board->isConnected($currentRow,$column);
                }

                $wordPosition = $currentRow-$row;
                $boardTile = $this->board->getTile($currentRow,$column);
                if (!$this->matchesBoardLetter($boardTile,$wordArray[$wordPosition])){
                    $matchesLetter = false;
                    break;
                }
            }

            if($isConnected && $matchesLetter)
                $this->addAvailableTile(new AvailableTile($this->board->getTile($row,$column),$row,$column,false));
        }

        if($wordLength + $column < 15
            && !$this->board->getTile($row,$wordLength+$column)->hasLetter()
            && ( $column -1 < 0 || !$this->board->getTile($row,$column-1)->hasLetter())
        ){
            $isConnected = false;
            $matchesLetter = true;
            for ($currentColumn = $column; $currentColumn < $column+$wordLength; $currentColumn++){
                if(!$isConnected){
                    $isConnected = $this->board->isConnected($row,$currentColumn);
                }

                $wordPosition = $currentColumn-$column;
                $boardTile = $this->board->getTile($row,$currentColumn);
                if (!$this->matchesBoardLetter($boardTile,$wordArray[$wordPosition])){
                    $matchesLetter = false;
                    break;
                }
            }

            if($isConnected && $matchesLetter)
                $this->addAvailableTile(new AvailableTile($this->board->getTile($row,$column),$row,$column,true));
        }
    }


    private function matchesBoardLetter(AbstractTile $tile, $char){
        if($tile->hasLetter()){
            if(mb_stripos($tile->getLetter()->getLetter(),$char) !== 0 ){
                return false;
            }
        }

        return true;
    }


    /**
     * @param AvailableTile $availableTile
     */
    private function addAvailableTile(AvailableTile $availableTile){
        if(!$this->isInAvailableTiles($availableTile)){
            $this->availableTiles[] = $availableTile;
        }
    }

    /**
     * @param AvailableTile $availableTile
     * @return bool
     */
    private function isInAvailableTiles(AvailableTile $availableTile){

        $row = $availableTile->getRow();
        $column = $availableTile->getColumn();
        $horizontal = $availableTile->isHorizontal();

        foreach ($this->availableTiles as $availableTile){
            if(
                $availableTile->getRow() === $row &&
                $availableTile->getColumn() === $column &&
                $availableTile->isHorizontal() === $horizontal
            ){
                return true;
            }
        }

        return false;
    }
}