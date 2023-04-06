<?php

namespace CashRegister\daos;

interface DAO
{

    public function insert(object $object): bool;
    public function selectOne(int $id): object;
    public function selectAll(): array;
    public function selectWhere(array $params): array;
    public function update(object $object): bool;
    public function delete(object $object): bool;
}