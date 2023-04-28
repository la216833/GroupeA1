<?php

namespace CashRegister\models;

class TVA
{
    private int $ID;
    private float $percent;
    private string $name;

    /**
     * @param int $ID
     * @param float $percent
     * @param string $name
     */
    public function __construct(int $ID, float $percent, string $name)
    {
        $this->ID = $ID;
        $this->percent = $percent;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getID(): int
    {
        return $this->ID;
    }

    /**
     * @param int $ID
     */
    public function setID(int $ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return $this->percent;
    }

    /**
     * @param float $percent
     */
    public function setPercent(float $percent): void
    {
        $this->percent = $percent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}