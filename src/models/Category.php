<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 28/03/2023
 *   Last Modified 30/03/2023
 */
namespace CashRegister\models;

class Category {

    /*-------------------------------CLASS ATTRIBUTES-------------------------------*/

    private int $ID;
    private String $Name;
    private String $Description;
    private bool $Active;

    /*-------------------------------CLASS CONSTRUCTOR-------------------------------*/

    /**
     * @param int $ID
     * @param String $Name
     * @param String $Description
     * @param bool $Active
     */
    public function __construct(int $ID, string $Name, string $Description, bool $Active)
    {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Active = $Active;
    }

    /*-------------------------------CLASS GETTERS AND SETTERS-------------------------------*/
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
     * @return String
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param String $Name
     */
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return String
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @param String $Description
     */
    public function setDescription(string $Description): void
    {
        $this->Description = $Description;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->Active;
    }

    /**
     * @param bool $Active
     */
    public function setActive(bool $Active): void
    {
        $this->Active = $Active;
    }


}