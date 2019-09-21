<?php

namespace SBL\Library;

/**
 * Bare-bones CRUD class taken from https://github.com/vortrixs/simple_pdo_crud and adjusted for actual use
 * @package SBL\Library
 */
class Crud
{
    /**
     * @var Database
     */
    private $db;

    /**
     * @var string
     */
    private $table;

    /**
     * Stores the database connection and the table we are using
     *
     * @param Database $db    Database object containing the PDO connection
     * @param string   $table Database table we are going to access
     */
    public function __construct(Database $db, string $table)
    {
        $this->db    = $db;
        $this->table = $table;
    }

    /**
     * Creates a new record in the database table
     *
     * @param  array<string,string|int|float|boolean> $data Data to insert formatted as array(columnName => value)
     *
     * @return string
     */
    public function create(array $data) : string
    {
        $sql = $this->db->prepareInsert($this->table, $data);

        if (false === $sql->execute()) {
            $this->fail($sql->errorInfo(), $sql->errorCode());
        }

        return $this->db->getConnection()->lastInsertId();
    }

    /**
     * Read rows from the table
     *
     * @param  array   $columns A list of columns to fetch
     * @param  array   $where   Multi-dimensional array
     * @param  integer $limit   How many rows to fetch
     *
     * @return array|false
     */
    public function read(array $columns = ['*'], array $where = [], int $limit = 0)
    {
        $sql = $this->db->prepareRead($this->table, $columns, $where, $limit);

        if (false === $sql->execute()) {
            $this->fail($sql->errorInfo(), $sql->errorCode());
        }

        if (1 === $limit) {
            return $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Updates specified columns in the table
     *
     * @param  array $data  The data that is being updated, formatted as array(columnName => newValue)
     * @param  array $where Multi-dimensional array
     *
     * @return integer
     */
    public function update(array $data, array $where) : int
    {
        $sql = $this->db->prepareUpdate($this->table, $data, $where);

        if (false === $sql->execute()) {
            $this->fail($sql->errorInfo(), $sql->errorCode());
        }

        return $sql->rowCount();
    }

    /**
     * Deletes rows from the table
     *
     * @param  array $where Multi-dimensional array
     *
     * @return boolean
     */
    public function delete($where = []) : bool
    {
        $sql = $this->db->prepareDelete($this->table, $where);

        if (false === $sql->execute()) {
            $this->fail($sql->errorInfo(), $sql->errorCode());
        }

        return true;
    }

    /**
     * Manually execute a SQL query
     *
     * @param  string $query Executes a SQL string
     * @return array
     */
    public function execute(string $query) : array
    {
        $sql = $this->db->getConnection()->query($query);

        if (false === $sql || false === $sql->execute()) {
            $this->fail($sql->errorInfo(), $sql->errorCode());
        }

        return $sql->fetchAll();
    }

    /**
     * Simple wrapper for throwing exceptions
     *
     * @param array  $sqlError
     * @param string $code
     */
    private function fail(array $sqlError, string $code) : void
    {
        throw new \RuntimeException(end($sqlError), (int) $code);
    }
}
