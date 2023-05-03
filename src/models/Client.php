<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 25/03/2023
 *   Last Modified 30/03/2023
 */
namespace CashRegister\models;

class Client
{

    /*-------------------------------CLASS ATTRIBUTES-------------------------------*/

    private int $ID;
    private String $name;
    private String $firstName;
    private String $TVANumber;
    private String $mail;
    private Address $address;
    private bool $active;

    /*-------------------------------CLASS CONSTRUCTOR-------------------------------*/


    /**
     * @param int $ID
     * @param String $name
     * @param String $firstName
     * @param String $TVANumber
     * @param String $mail
     * @param Address $address
     * @param bool $active
     */
    public function __construct(int $ID, string $name, string $firstName, string $TVANumber, string $mail, bool $active, Address $address)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->TVANumber = $TVANumber;
        $this->mail = $mail;
        $this->address = $address;
        $this->active = $active;
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
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param String $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return String
     */
    public function getTVANumber(): string
    {
        return $this->TVANumber;
    }

    /**
     * @param String $TVANumber
     */
    public function setTVANumber(string $TVANumber): void
    {
        $this->TVANumber = $TVANumber;
    }

    /**
     * @return String
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param String $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
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

}