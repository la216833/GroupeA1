<?php

namespace CashRegister\models;

class Sale {

    /** @var int $id */
    private int $id;
    /** @var string $date */
    private string $date;
    /** @var float $amount */
    private float $amount;
    /** @var string $description */
    private string $description;
    /** @var User $user */
    private User $user;
    /** @var Client client */
    private Client $client;

    public function __construct(int $id, string $date, float $amount, string $description, User $user, Client
    $client) {
        $this->id = $id;
        $this->date = $date;
        $this->amount = $amount;
        $this->description = $description;
        $this->user = $user;
        $this->client = $client;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getAmount(): float {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }

    /**
     * @return Client
     */
    public function getClient(): Client {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void {
        $this->client = $client;
    }
}
