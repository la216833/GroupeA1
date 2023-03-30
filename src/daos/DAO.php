<?php

namespace CashRegister\daos;

interface DAO
{
    public function insert(string $table, array $params): bool;
    public function selectOne(string $table, int $id): object;
    public function selectAll(string $table): array;
    public function selectWhere(string $table, array $params): array;
    public function update(string $table, array $params): bool;
    public function delete(string $table, array $params): bool;
}