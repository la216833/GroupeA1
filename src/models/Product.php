<?php

namespace CashRegister\models;

class Product
{
    private int $ID;
    private string $name;
    private string $description;
    private float $price;
    private bool $active;
    private string $imagePath;
    private TVA $tva;
    private Category $category;

    /**
     * @param int $ID
     * @param string $name
     * @param string $description
     * @param float $price
     * @param bool $active
     * @param string $imagePath
     * @param TVA $tva
     * @param Category $category
     */
    public function __construct(int $ID, string $name, string $description, float $price, bool $active, string $imagePath, TVA $tva, Category $category)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->active = $active;
        $this->imagePath = $imagePath;
        $this->tva = $tva;
        $this->category = $category;
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
     * @return TVA
     */
    public function getTva(): TVA
    {
        return $this->tva;
    }

    /**
     * @param TVA $tva
     */
    public function setTva(TVA $tva): void
    {
        $this->tva = $tva;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }




}