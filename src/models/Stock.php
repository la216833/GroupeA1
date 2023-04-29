<?php

namespace CashRegister\models;

class Stock
{
    private int $ID;
    private int $quantity;
    private string $date;
    private float $buyPrice;
    private bool $active;
    private Product $product;

    /**
     * @param int $ID
     * @param int $quantity
     * @param string $date
     * @param float $buyPrice
     * @param bool $active
     * @param Product $product
     */
    public function __construct(int $ID, int $quantity, string $date, float $buyPrice, bool $active, Product $product)
    {
        $this->ID = $ID;
        $this->quantity = $quantity;
        $this->date = $date;
        $this->buyPrice = $buyPrice;
        $this->active = $active;
        $this->product = $product;
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
    public function getActive(): bool
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
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
