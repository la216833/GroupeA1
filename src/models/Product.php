<?php

namespace CashRegister\models;

class Product
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private bool $isAvailable;
    private string $imagePath;
    private int $tvaID;
    private array $stockIDs;

    /**
     * @param string $name
     * @param string $description
     * @param float $price
     * @param bool $isAvailable
     * @param string $imagePath
     * @param array $stockIDs
     * @param int $tvaID
     */
    public function __construct(string $name, string $description, float $price, bool $isAvailable, string $imagePath, array $stockIDs, int $tvaID)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->isAvailable = $isAvailable;
        $this->imagePath = $imagePath;
        $this->stockIDs = $stockIDs;
        $this->tvaID = $tvaID;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    /**
     * @param bool $isAvailable
     */
    public function setIsAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
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
    public function getTvaID(): int
    {
        return $this->tvaID;
    }

    /**
     * @param int $tvaID
     */
    public function setTvaID(int $tvaID): void
    {
        $this->tvaID = $tvaID;
    }

    /**
     * @return array
     */
    public function getStockIDs(): array
    {
        return $this->stockIDs;
    }

    /**
     * @param array $stockIDs
     */
    public function setStockIDs(array $stockIDs): void
    {
        $this->stockIDs = $stockIDs;
    }

}