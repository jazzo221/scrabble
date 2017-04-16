<?php

namespace AppBundle\Entity;

use AppBundle\Model\Board\Tiles\AbstractTile;
use AppBundle\Model\RenderableInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation as JMS;

/**
 * Letter
 *
 * @ORM\Table(name="letter")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LetterRepository")
 */
class Letter implements RenderableInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="letter", type="string", length=1, unique=false, options={"collation":"utf8_bin"})
     *
     * @Assert\Length(min=1,max=1)
     */
    private $letter;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @var LetterConfiguration
     * @ORM\ManyToOne(targetEntity="LetterConfiguration", inversedBy="letters")
     * @ORM\JoinColumn()
     *
     * @JMS\Exclude
     */
    private $letterConfiguration;

    /**
     * @var AbstractTile
     *
     * @JMS\Exclude
     */
    private $tile;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set letter
     *
     * @param string $letter
     *
     * @return Letter
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * Get letter
     *
     * @return string
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return Letter
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Letter
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return AbstractTile
     */
    public function getTile()
    {
        return $this->tile;
    }

    /**
     * @param AbstractTile $tile
     * @return Letter
     */
    public function setTile($tile)
    {
        $this->tile = $tile;
        return $this;
    }



    function __toString()
    {
        return $this->letter;
    }


    /**
     * @return string
     */
    public function render()
    {
        return $this->getLetter().'<sub>'.$this->getPoints().'</sub>';
    }

    /**
     * Set letterConfiguration
     *
     * @param \AppBundle\Entity\LetterConfiguration $letterConfiguration
     *
     * @return Letter
     */
    public function setLetterConfiguration(\AppBundle\Entity\LetterConfiguration $letterConfiguration = null)
    {
        $this->letterConfiguration = $letterConfiguration;

        return $this;
    }

    /**
     * Get letterConfiguration
     *
     * @return \AppBundle\Entity\LetterConfiguration
     */
    public function getLetterConfiguration()
    {
        return $this->letterConfiguration;
    }
}
