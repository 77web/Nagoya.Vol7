<?php


namespace Nagoya\Vol7\Entity;


class Point
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $disabled;

    /**
     * @var array
     */
    private $nextPoints;

    /**
     * @var bool
     */
    private $goal;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->disabled = false;
    }

    /**
     * この地点を通行止めにする
     */
    public function disable()
    {
        $this->disabled = true;
    }

    /**
     * ゴールフラグをセット
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * @return bool
     */
    public function isGoal()
    {
        return $this->goal;
    }

    /**
     * @return Point[]
     */
    public function getNextPoints()
    {
        return $this->nextPoints;
    }

    /**
     * @param array $nextPoints
     * @return Point
     */
    public function setNextPoints(array $nextPoints)
    {
        $this->nextPoints = $nextPoints;

        return $this;
    }
}
