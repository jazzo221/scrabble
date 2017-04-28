<?php
/**
 * Created by PhpStorm.
 * User: Jeziorski
 * Date: 1. 2. 2017
 * Time: 11:27
 */

namespace AppBundle\Model\Board;


use AppBundle\Model\Board\Tiles\AbstractTile;
use AppBundle\Model\Board\Tiles\DoubleLetterBonus;
use AppBundle\Model\Board\Tiles\DoubleWordBonus;
use AppBundle\Model\Board\Tiles\Simple;
use AppBundle\Model\Board\Tiles\TripleLetterBonus;
use AppBundle\Model\Board\Tiles\TripleWordBonus;
use AppBundle\Model\RenderableInterface;

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

    /**
     * clones Board object and all its tiles
     */
    function __clone()
    {
        foreach ($this->board as $rowKey => $row){
            /** @var AbstractTile $tile */
            foreach ($row as $column => $tile){
                $this->board[$rowKey][$column] = clone $tile;
            }
        }
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
     * @param $row
     * @param $column
     * @return AbstractTile
     */
    public function getTile($row, $column){
        return $this->board[$row][$column];
    }

    public function isConnected ($row, $column){
        return ($row - 1 >= 0 && $this->getTile($row-1, $column)->hasLetter()) ||
            ($row + 1 < 15 && $this->getTile($row+1, $column)->hasLetter()) ||
            ($column - 1 >= 0 && $this->getTile($row, $column-1)->hasLetter()) ||
            ($column + 1 < 15 && $this->getTile($row, $column+1)->hasLetter());
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