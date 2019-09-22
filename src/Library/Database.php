<?php

namespace SBL\Library;

/**
 * Bare-bones database handler taken from https://github.com/vortrixs/simple_pdo_crud and adjusted for actual use
 * @package SBL\Library
 */
class Database
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * Creates a connection to a MySQL database
     *
     * @param string $dsn     The driver, database and host to connect to
     * @param string $user    Username
     * @param string $passwd  Password
     * @param array  $options PDO Driver options {@see http://php.net/manual/en/ref.pdo-mysql.php}
     */
    public function __construct(string $dsn, string $user, string $passwd, array $options = [])
    {
        $this->connection = new \PDO($dsn, $user, $passwd, $options);
    }

    /**
     * @return \PDO
     */
    public function getConnection() : \PDO
    {
        return $this->connection;
    }

    /**
     * @param string $table
     * @param array  $data
     *
     * @return boolean|\PDOStatement
     */
    public function prepareInsert(string $table, array $data)
    {
        $columns      = array_keys($data);
        $values       = array_values($data);
        $placeholders = $this->generatePlaceholders($columns);
        
        $strColumns      = implode(',', $columns);
        $strPlaceholders = implode(',', $placeholders);

        $statement = $this->connection->prepare("INSERT INTO {$table} ({$strColumns}) VALUES ({$strPlaceholders})");

        foreach (array_combine($placeholders, $values) as $placeholder => $value) {
            $statement->bindValue($placeholder, $value);
        }

        return $statement;
    }

    /**
     * @param string  $table
     * @param array   $columns
     * @param array   $where
     * @param integer $limit
     *
     * @return boolean|\PDOStatement
     */
    public function prepareRead(string $table, array $columns, array $where, int $limit = 0)
    {
        $columns = implode(',', $columns);

        $placeholders = [];

        $query  = "SELECT {$columns} FROM {$table}";
        $query .= $this->processWhere($where, $placeholders);

        if ($limit > 0) {
            $query .= " LIMIT {$limit}";
        }

        $statement = $this->connection->prepare($query);

        if (!empty($placeholders)) {
            foreach ($placeholders as $placeholder => $value) {
                $statement->bindValue($placeholder, $value);
            }
        }

        return $statement;
    }

    /**
     * @param string $table
     * @param array  $data
     * @param array  $where
     *
     * @return boolean|\PDOStatement
     */
    public function prepareUpdate(string $table, array $data, array $where)
    {
        $placeholders = $this->generatePlaceholders(array_keys($data));
        $pColumns     = array_combine($placeholders, array_keys($data));
        $pValues      = array_combine($placeholders, array_values($data));

        $set = '';

        foreach ($pColumns as $placeholder => $column) {
            $set .= "{$column} = {$placeholder},";
        }

        $set    = rtrim($set, ',');
        $query  = "UPDATE {$table} SET {$set}";
        $query .= $this->processWhere($where, $pValues);

        $statement = $this->connection->prepare($query);

        unset($placeholder);

        foreach ($pValues as $placeholder => $value) {
            $statement->bindValue($placeholder, $value);
        }

        return $statement;
    }

    /**
     * @param string $table
     * @param array  $where
     *
     * @return boolean|\PDOStatement
     */
    public function prepareDelete(string $table, array $where)
    {
        $placeholders = [];

        $query  = "DELETE FROM {$table}";
        $query .= $this->processWhere($where, $placeholders);

        $statement = $this->connection->prepare($query);

        if (!empty($placeholders)) {
            foreach ($placeholders as $placeholder => $value) {
                $statement->bindValue($placeholder, $value);
            }
        }

        return $statement;
    }

    /**
     * @param array $columns
     *
     * @return array
     */
    private function generatePlaceholders(array $columns) : array
    {
        foreach ($columns as &$column) {
            $column = ":{$column}";
        }

        return $columns;
    }

    /**
     * @param array $where
     * @param array $placeholders
     *
     * @return string
     */
    private function processWhere(array $where, array &$placeholders) : string
    {
        $string = '';

        foreach ($where as $clause) {
            if (count($clause) !== 4) {
                throw new \RuntimeException('All where clauses must contain 4 parameters.');
            }

            foreach ($clause as $key => $value) {
                if ($key < 3) {
                    $string .= " {$value}";
                } elseif ($key === 3) {
                    $string .= " :{$clause[$key-2]}";
                }

                if (1 === $key) {
                    $placeholders[":{$value}"] = $clause[$key+2];
                }
            }
        }

        return $string;
    }
}
