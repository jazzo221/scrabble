<?php
/**
 * Created by PhpStorm.
 * User: Jeziorski
 * Date: 1. 2. 2017
 * Time: 11:27
 */

namespace AppBundle\Board;


use AppBundle\Board\Tiles\Simple;

class Board
{

    private $columns = 15;

    private $rows = 15;

    /**
     * @var array[][]
     */
    private $board;

    public function __construct()
    {
        $this->buildBoard();
    }


    protected function buildBoard(){
        for($row = 0; $row <= $this->rows; $row++){
            for($column = 0; $column <= $this->columns; $column++){
                $this->board[$row][$column] = new Simple();
            }
        }

//        $this->board[]
    }


}