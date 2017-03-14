<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scoresheet
 *
 * @ORM\Table(name="scoresheet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScoresheetRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Scoresheet
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * @var int
     *
     * @ORM\OneToMany(targetEntity="Turn", mappedBy="scoresheet", cascade={"persist"})
     */
    private $turns;

    /**
     * @var Game
     *
     * @ORM\OneToOne(targetEntity="Game", inversedBy="scoresheet")
     * @ORM\JoinColumn()
     */
    private $game;


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
     * Set game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return Scoresheet
     */
    public function setGame(\AppBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->turns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add turn
     *
     * @param \AppBundle\Entity\Turn $turn
     *
     * @return Scoresheet
     */
    public function addTurn(\AppBundle\Entity\Turn $turn)
    {
        $turn->setScoresheet($this);
        $this->turns[] = $turn;

        return $this;
    }

    /**
     * Remove turn
     *
     * @param \AppBundle\Entity\Turn $turn
     */
    public function removeTurn(\AppBundle\Entity\Turn $turn)
    {
        $this->turns->removeElement($turn);
    }

    /**
     * Get turns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTurns()
    {
        return $this->turns;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Scoresheet
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Scoresheet
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}
