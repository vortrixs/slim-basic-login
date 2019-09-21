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
    public function __construct(Database $db, $table)
    {
        $this->db    = $db;
        $this->table = $table;
    }

    /**
     * Creates a new record in the database table
     *
     * @param  array<string,string|int|float|boolean> $data Data to insert formatted as array(columnName => value)
     *
     * @return integer
     */
    public function create($data)
    {
        $sql = $this->db->prepareInsert($this->table, $data);

        if (false === $sql->execute()) {
            throw new \RuntimeException($sql->errorInfo(), $sql->errorCode());
        }

        return $this->db->getConnection()->lastInsertId();
    }

    /**
     * Read rows from the table
     *
     * @param  array         $columns A list of columns to fetch
     * @param  array|string  $where   Multi-dimensional array or a SQL string for complex restrictions
     *                                Refer to the readme for examples
     * @param  integer       $limit   How many rows to fetch
     *
     * @return array
     */
    public function read($columns = ['*'], $where = [], $limit = 0)
    {
        $sql = $this->db->prepareRead($this->table, $columns, $where, $limit);

        if (false === $sql->execute()) {
            throw new \RuntimeException($sql->errorInfo(), $sql->errorCode());
        }

        if (1 === $limit) {
            return $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Updates specified columns in the table
     *
     * @param  array        $data  The data that is being updated, formatted as array(columnName => newValue)
     * @param  array|string $where Multi-dimensional array or a SQL string for complex restrictions
     *                             Refer to the readme for examples
     *
     * @return integer
     */
    public function update($data, $where)
    {
        $sql = $this->db->prepareUpdate($this->table, $data, $where);

        if (false === $sql->execute()) {
            throw new \RuntimeException($sql->errorInfo(), $sql->errorCode());
        }

        return $sql->rowCount();
    }

    /**
     * Deletes rows from the table
     *
     * @param  array|string  $where Multi-dimensional array or a SQL string for complex restrictions
     *                              Refer to the readme for examples
     *
     * @return boolean
     */
    public function delete($where = [])
    {
        $sql = $this->db->prepareDelete($this->table, $where);

        if (false === $sql->execute()) {
            throw new \RuntimeException($sql->errorInfo(), $sql->errorCode());
        }

        return true;
    }

    /**
     * Manually execute a SQL query
     *
     * @param  string $query [description]
     * @return array
     */
    public function execute($query)
    {
        $sql = $this->db->getConnection()->query($query);

        if (false === $sql || false === $sql->execute()) {
            throw new \RuntimeException($sql->errorInfo(), $sql->errorCode());
        }

        return $sql->fetchAll();
    }
}