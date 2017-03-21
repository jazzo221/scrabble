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

class Board implements RenderableInterface
{

    /**
     * @var Word
     */
    private $words;

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

    public function placeLetter(Letter $letter, $row, $column){
        $tile = $this->board[$row][$column];

        if(!$tile instanceof AbstractTile){
            throw new \Exception('Tile at row: '.$row.' column: '.$column.' does not exists');
        }

        if($tile->hasLetter())
            throw new \Exception('Tile at row: '.$row.' column: '.$column.' already has letter '.$tile->getLetter()->getLetter());

        $tile->setLetter($letter);
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