<?php

namespace Database;

interface DatabaseInterface
{
    public function query(string $query) : StatementInterface;

    public function getErrorInfo() : array;

    public function lastId() : int;

}