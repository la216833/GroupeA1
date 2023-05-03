<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 06/04/2023
 *   Last Modified 06/04/2023
 */
namespace CashRegister\models;

class Address
{

    private int $ID;
    private String $Street;
    private String $Number;
    private String $City;
    private String $Country;

    /**
     * @param int $ID
     * @param String $Street
     * @param String $Number
     * @param String $City
     * @param String $Country
     */
    public function __construct(int $ID, string $Street, string $Number, string $City, string $Country)
    {
        $this->ID = $ID;
        $this->Street = $Street;
        $this->Number = $Number;
        $this->City = $City;
        $this->Country = $Country;
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
     * @return String
     */
    public function getStreet(): string
    {
        return $this->Street;
    }

    /**
     * @param String $Street
     */
    public function setStreet(string $Street): void
    {
        $this->Street = $Street;
    }

    /**
     * @return String
     */
    public function getNumber(): string
    {
        return $this->Number;
    }

    /**
     * @param String $Number
     */
    public function setNumber(string $Number): void
    {
        $this->Number = $Number;
    }

    /**
     * @return String
     */
    public function getCity(): string
    {
        return $this->City;
    }

    /**
     * @param String $City
     */
    public function setCity(string $City): void
    {
        $this->City = $City;
    }

    /**
     * @return String
     */
    public function getCountry(): string
    {
        return $this->Country;
    }

    /**
     * @param String $Country
     */
    public function setCountry(string $Country): void
    {
        $this->Country = $Country;
    }



}