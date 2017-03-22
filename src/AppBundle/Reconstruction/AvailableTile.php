<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Reconstruction;


use AppBundle\Model\Board\Tiles\AbstractTile;

class AvailableTile
{

    /**
     * @var AbstractTile
     */
    private $tile;

    /**
     * @var int
     */
    private $row;

    /**
     * @var int
     */
    private $column;

    /**
     * AvailableTile constructor.
     * @param AbstractTile $tile
     * @param int $row
     * @param int $column
     */
    public function __construct(AbstractTile $tile, $row, $column)
    {
        $this->tile = $tile;
        $this->row = $row;
        $this->column = $column;
    }

    /**
     * @return AbstractTile
     */
    public function getTile()
    {
        return $this->tile;
    }

    /**
     * @return int
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getColumn()
    {
        return $this->column;
    }




}