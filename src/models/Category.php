<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 28/03/2023
 *   Last Modified 30/03/2023
 */
namespace CashRegister\models;

class Category {

    /*-------------------------------CLASS ATTRIBUTES-------------------------------*/

    private int $CategoryID;
    private String $CategoryName;
    private String $CategoryDescription;
    private bool $CategoryActive;

    /*-------------------------------CLASS CONSTRUCTOR-------------------------------*/

    /**
     * @param int $CategoryID
     * @param String $CategoryName
     * @param String $CategoryDescription
     */
    public function __construct(int $CategoryID, String $CategoryName,
                                String $CategoryDescription) {

        $this->CategoryID = $CategoryID;
        $this->CategoryName = $CategoryName;
        $this->CategoryDescription = $CategoryDescription;
        $this->CategoryActive = true;

    }

    /*-------------------------------CLASS GETTERS AND SETTERS-------------------------------*/

    /**
     * @return int
     */
    public function getCategoryID(): int
    {
        return $this->CategoryID;
    }

    /**
     * @param int $CategoryID
     */
    public function setCategoryID(int $CategoryID): void
    {
        $this->CategoryID = $CategoryID;
    }

    /**
     * @return String
     */
    public function getCategoryName(): string
    {
        return $this->CategoryName;
    }

    /**
     * @param String $CategoryName
     */
    public function setCategoryName(string $CategoryName): void
    {
        $this->CategoryName = $CategoryName;
    }

    /**
     * @return String
     */
    public function getCategoryDescription(): string
    {
        return $this->CategoryDescription;
    }

    /**
     * @param String $CategoryDescription
     */
    public function setCategoryDescription(string $CategoryDescription): void
    {
        $this->CategoryDescription = $CategoryDescription;
    }

    /**
     * @return bool
     */
    public function isCategoryActive(): bool
    {
        return $this->CategoryActive;
    }

    /**
     * @param bool $CategoryActive
     */
    public function setCategoryActive(bool $CategoryActive): void
    {
        $this->CategoryActive = $CategoryActive;
    }


}