<?php
/**
 * Created by PhpStorm.
 * User: Jeziorski
 * Date: 1. 2. 2017
 * Time: 11:27
 */

namespace AppBundle\Model\Board;


use AppBundle\Entity\Letter;
use AppBundle\Model\Board\Tiles\AbstractTile;
use AppBundle\Model\Board\Tiles\DoubleLetterBonus;
use AppBundle\Model\Board\Tiles\DoubleWordBonus;
use AppBundle\Model\Board\Tiles\Simple;
use AppBundle\Model\Board\Tiles\TripleLetterBonus;
use AppBundle\Model\Board\Tiles\TripleWordBonus;
use AppBundle\Model\RenderableInterface;
use AppBundle\Model\Word\Word;
use AppBundle\Reconstruction\AvailableTile;

class Board implements RenderableInterface
{


    /**
     * @var array[][]
     */
    private $board;

    public function __construct()
    {
        $this->buildBoard();
    }


    protected function buildBoard(){
        $this->board = [
            [new TripleWordBonus(),new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleWordBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new TripleWordBonus()],
            [new Simple(),new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple()],
            [new Simple(),new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple()],
            [new DoubleLetterBonus(),new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new DoubleLetterBonus()],
            [new Simple(),new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new Simple()],
            [new Simple(),new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple()],
            [new Simple(),new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple()],
            [new TripleWordBonus(),new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new TripleWordBonus()],
            [new Simple(),new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple()],
            [new Simple(),new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple()],
            [new Simple(),new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new Simple()],
            [new DoubleLetterBonus(),new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new DoubleLetterBonus()],
            [new Simple(),new Simple(), new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple(), new Simple()],
            [new Simple(),new DoubleWordBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleLetterBonus(), new Simple(), new Simple(), new Simple(), new DoubleWordBonus(), new Simple()],
            [new TripleWordBonus(),new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new Simple(), new TripleWordBonus(), new Simple(), new Simple(), new Simple(), new DoubleLetterBonus(), new Simple(), new Simple(), new TripleWordBonus()],
        ];
    }

    /**
     * Returns tiles where at least one letter has to be placed
     *
     * @return AvailableTile[]
     */
    public function getAvailableTiles(){
        $availableTiles = [];

        for($row = 0; $row < 15; $row++){
            for($column = 0; $column < 15; $column++){
                //check surrounding for tiles and letters
                if(
                    (isset($this->board[$row-1][$column]) && $this->getTile($row-1,$column)->hasLetter()) ||
                    (isset($this->board[$row+1][$column]) && $this->getTile($row+1,$column)->hasLetter()) ||
                    (isset($this->board[$row][$column-1]) && $this->getTile($row,$column-1)->hasLetter()) ||
                    (isset($this->board[$row][$column+1]) && $this->getTile($row,$column+1)->hasLetter())
                ){
                    $availableTiles[] = new AvailableTile($this->getTile($row,$column),$row,$column);
                }
            }
        }

        return $availableTiles;
    }

    /**
     * @param $row
     * @param $column
     * @return AbstractTile
     */
    public function getTile($row, $column){
        return $this->board[$row][$column];
    }


    /**
     * @return string
     */
    public function render()
    {
        $html = "<div class='table-responsive'><table class='table table-bordered board'>";

        foreach ($this->board as $row){
            $html .= "<tr class='row'>";

            /** @var AbstractTile $tile */
            foreach ($row as $tile){
                $html .= $tile->render();
            }
            $html .= "</tr>";
        }


        $html .= "</table></div>";

        return $html;
    }
}