<?php
namespace AppBundle\Model\Board\Tiles;


use AppBundle\Entity\Letter;
use AppBundle\Model\RenderableInterface;
use AppBundle\Model\Word\Word;

abstract class AbstractTile implements RenderableInterface
{

    /**
     * @var Letter
     */
    protected $letter;

    /**
     * @return Letter
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * @param Letter $letter
     */
    public function setLetter($letter)
    {
        $letter->setTile($this);
        $this->letter = $letter;
    }

    /**
     * @return bool
     */
    public function hasLetter()
    {
        return !!$this->letter;
    }

    /**
     * @param Letter $letter
     * @param Word $word
     * @return int
     */
    public abstract function getScore(Letter $letter);
}