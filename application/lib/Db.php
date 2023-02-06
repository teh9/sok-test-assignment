<?php

/**
 * Here, of course, one could use some kind of ORM like RedBeanPHP to make the code more readable and simpler,
 * but since I started without information about the possibility of using it, so why not :)
 */

namespace application\lib;

use PDO;
use PDOStatement;

class Db
{
    /**
     * @var string
     */
    public string $table;

    /**
     * @var PDO
     */
    protected PDO $db;

    public function __construct()
    {
        $config = require 'application/config/db.php';

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s',
            $config['host'],
            $config['dbname']
        );

        $this->db = new PDO($dsn, $config['user'], $config['password']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->db->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
    }

    /**
     * Set table name.
     *
     * @param string $tableName
     * @return $this
     */
    public function table (string $tableName): static
    {
        $this->table = $tableName;
        return $this;
    }

    /**
     * Executes a SQL query on the database.
     *
     * @param string $sql
     * @param array $params
     * @param bool $fetchAll
     * @return PDOStatement|array|null
     */
    public function query(string $sql, array $params = [], bool $fetchAll = false): PDOStatement|array|null
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        if ($fetchAll) {
            return $stmt->fetchAll();
        }

        $row = $stmt->fetch();
        if ($row === false) {
            return null;
        }

        return $row;

    }

    /**
     * Inserting data to table.
     *
     * @param array $data
     * @return bool
     */
    public function insert (array $data): bool
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_map( static function() {
            return '?';
        }, $data));

        $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";

        $stmt = $this->db->prepare($sql);

        $i = 1;
        foreach ($data as $value) {
            $stmt->bindValue($i, $value);
            $i++;
        }

        return $stmt->execute();
    }

    /**
     * Deleting data from table.
     *
     * @param int $id
     * @return bool
     */
    public function delete (int $id): bool
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        return $this->db->prepare($sql)->execute([$id]);
    }

    /**
     * Updating data in database.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function update (int $id, array $params = []): bool
    {
        $sql  = "UPDATE sections SET name = ?, description = ?, parent_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $params['name']);
        $stmt->bindValue(2, $params['description']);
        $stmt->bindValue(3, $params['parent_id']);
        $stmt->bindValue(4, $id);

        return $stmt->execute();
    }
}
