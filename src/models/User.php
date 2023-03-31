<?php

namespace CashRegister\models;

class User {

    /** @var int $id User id */
    private int $id;
    /** @var string $name User name */
    private string $name;
    /** @var string $firstname User firstname */
    private string $firstname;
    /** @var string $accessCode User access code */
    private string $accessCode;
    /** @var string $imagePath User image path */
    private string $imagePath;
    /** @var bool $status User status */
    private bool $status;
    /** @var Role $role User role */
    private Role $role;

    public function __construct(int $id, string $name, string $firstname, string $accessCode, string $imagePath,
                                bool $status, Role $role) {
        $this->id = $id;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->accessCode = $accessCode;
        $this->imagePath = $imagePath;
        $this->status = $status;
        $this->role = $role;
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
     * @return string
     */
    public function getFirstname(): string {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getAccessCode(): string {
        return $this->accessCode;
    }

    /**
     * @param string $accessCode
     */
    public function setAccessCode(string $accessCode): void {
        $this->accessCode = $accessCode;
    }

    /**
     * @return string
     */
    public function getImagePath(): string {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath): void {
        $this->imagePath = $imagePath;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void {
        $this->status = $status;
    }

    /**
     * @return Role
     */
    public function getRole(): Role {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void {
        $this->role = $role;
    }
}