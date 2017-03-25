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
     * Every bonus can be used only once
     *
     * @var bool
     */
    protected $usedBonus = false;

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
     * @param $usedBonus
     * @return $this
     */
    public function setUsedBonus($usedBonus){
        $this->usedBonus = $usedBonus;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUsedBonus(){
        return $this->usedBonus;
    }

    /**
     * @param Letter $letter
     * @param Word $word
     * @return int
     */
    public abstract function getScore(Letter $letter);
}