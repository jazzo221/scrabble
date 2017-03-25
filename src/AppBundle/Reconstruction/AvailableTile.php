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
     * @var boolean
     */
    private $horizontal;

    /**
     * AvailableTile constructor.
     * @param AbstractTile $tile
     * @param int $row
     * @param int $column
     * @param boolean $horizontal
     */
    public function __construct(AbstractTile $tile, $row, $column, $horizontal)
    {
        $this->tile = $tile;
        $this->row = $row;
        $this->column = $column;
        $this->horizontal = $horizontal;
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


    /**
     * @param bool $horizontal
     */
    public function setHorizontal($horizontal)
    {
        $this->horizontal = $horizontal;
    }

    /**
     * @return bool
     */
    public function isHorizontal()
    {
        return $this->horizontal;
    }


}