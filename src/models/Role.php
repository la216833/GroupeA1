<?php

namespace CashRegister\models;

class Role {

    /** @var int $id Role id */
    private int $id;
    /** @var string $name Role name */
    private string $name;
    /** @var bool $Active Role isActive */
    private bool $active;

    public function __construct(int $id, string $name, bool $active) {
        $this->id = $id;
        $this->name = $name;
        $this->active = $active;
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
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function getActive(): bool {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void {
        $this->active = $active;
    }
}