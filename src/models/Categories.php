<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 28/03/2023
 *   Last Modified 30/03/2023
 */
namespace CashRegister\models;

class Categories {

    /*-------------------------------CLASS ATTRIBUTES-------------------------------*/

    private int $CategoriesID;
    private String $CategoriesName;
    private String $CategoriesDescription;
    private bool $CategoriesActive;

    /*-------------------------------CLASS CONSTRUCTOR-------------------------------*/

    /**
     * @param int $CategoriesID
     * @param String $CategoriesName
     * @param String $CategoriesDescription
     */
    public function __construct(int $CategoriesID, String $CategoriesName,
                                String $CategoriesDescription) {

        $this->CategoriesID = $CategoriesID;
        $this->CategoriesName = $CategoriesName;
        $this->CategoriesDescription = $CategoriesDescription;
        $this->CategoriesActive = true;

    }

    /*-------------------------------CLASS GETTERS AND SETTERS-------------------------------*/

    /**
     * @return int
     */
    public function getCategoriesID(): int
    {
        return $this->CategoriesID;
    }

    /**
     * @param int $CategoriesID
     */
    public function setCategoriesID(int $CategoriesID): void
    {
        $this->CategoriesID = $CategoriesID;
    }

    /**
     * @return String
     */
    public function getCategoriesName(): string
    {
        return $this->CategoriesName;
    }

    /**
     * @param String $CategoriesName
     */
    public function setCategoriesName(string $CategoriesName): void
    {
        $this->CategoriesName = $CategoriesName;
    }

    /**
     * @return String
     */
    public function getCategoriesDescription(): string
    {
        return $this->CategoriesDescription;
    }

    /**
     * @param String $CategoriesDescription
     */
    public function setCategoriesDescription(string $CategoriesDescription): void
    {
        $this->CategoriesDescription = $CategoriesDescription;
    }

    /**
     * @return bool
     */
    public function isCategoriesActive(): bool
    {
        return $this->CategoriesActive;
    }

    /**
     * @param bool $CategoriesActive
     */
    public function setCategoriesActive(bool $CategoriesActive): void
    {
        $this->CategoriesActive = $CategoriesActive;
    }


}