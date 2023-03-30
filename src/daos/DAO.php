<?php

namespace CashRegister\daos;

interface DAO
{

    public function insert(object $insertedObject): bool;
    public function selectOne(int $id): object;
    public function selectAll(): array;
    public function selectWhere(array $params): array;
    public function update(object $objectToUpdate): bool;
    public function delete(object $objectToDelete): bool;
}