<?php

namespace CashRegister\daos;

interface DAO
{
    public function insert(object $insertedObject): bool;
    public function selectOne(object $selectedObject): object;
    public function selectAll(object $selectedObjects): array;
    public function selectWhere(object $selectedObjects): array;
    public function update(object $objectToUpdate): bool;
    public function delete(object $objectToDelete): bool;
}