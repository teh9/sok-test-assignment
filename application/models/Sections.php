<?php

namespace application\models;

use application\core\Model;
use PDOStatement;

class Sections extends Model
{
    /**
     * @return array|PDOStatement|null
     */
    public function getAllSections (): array|PDOStatement|null
    {
        return $this->db->query('SELECT * FROM sections', [], true);
    }

    /**
     * This SQL query will return information about section, and it's children.
     *
     * @param string $id
     * @return array|PDOStatement|null
     */
    public function getSectionInformation (string $id): array|PDOStatement|null
    {
        $query = 'SELECT parent.*, child.id as child_id, child.name as child_name 
                  FROM sections parent 
                  LEFT JOIN sections child ON child.parent_id = parent.id 
                  WHERE parent.id = ?';

        return $this->db->query($query, [$id], true);
    }

    /**
     * @param int $id
     * @return array|PDOStatement|null
     */
    public function getSectionById (int $id): array|PDOStatement|null
    {
        return $this->db->query('SELECT * FROM sections WHERE id = ?', [$id]);
    }
}
