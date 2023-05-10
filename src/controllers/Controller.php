<?php

namespace CashRegister\controllers;

interface Controller {
    public function get(): void;
    public function get_one(int $id): void;
    public function add(): void;
    public function post(array $params):void;
    public function post_one(int $id): void;
    public function update(int $id): void;
    public function delete(int $id): void;

}
