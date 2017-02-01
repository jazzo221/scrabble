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