<?php

namespace CashRegister\models;

class Stock
{
    private int $id;
    private int $quantity;
    private string $date;
    private float $buyPrice;
    private bool $active;
    private int $productID;

    /**
     * @param int $quantity
     * @param string $date
     * @param float $buyPrice
     * @param bool $active
     * @param int $productID
     */
    public function __construct(int $quantity, string $date, float $buyPrice, bool $active, int $productID)
    {
        $this->quantity = $quantity;
        $this->date = $date;
        $this->buyPrice = $buyPrice;
        $this->active = $active;
        $this->productID = $productID;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getBuyPrice(): float
    {
        return $this->buyPrice;
    }

    /**
     * @param float $buyPrice
     */
    public function setBuyPrice(float $buyPrice): void
    {
        $this->buyPrice = $buyPrice;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getProductID(): int
    {
        return $this->productID;
    }

    /**
     * @param int $productID
     */
    public function setProductID(int $productID): void
    {
        $this->productID = $productID;
    }

}
