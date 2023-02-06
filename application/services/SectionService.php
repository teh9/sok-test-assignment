<?php

namespace application\services;

use application\lib\Db;

class SectionService
{
    public string $message;

    /**
     * Creating section.
     *
     * @param array $data
     * @param Db $database
     * @return bool
     */
    public function createSection (array $data, Db $database): bool
    {
        $name        = $data['name'];
        $description = $data['description'];

        if (empty($name) || empty($description)) {
            $this->message = 'Name and description must not be empty.';
            return false;
        }

        if ($data['parent_id'] === 'null') {
            $data['parent_id'] = null;
        }

        try {
            $database->table('sections')->insert($data);
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * Updating section.
     *
     * @param int $id
     * @param array $data
     * @param Db $database
     * @return bool
     */
    public function updateSection (int $id, array $data, Db $database): bool
    {
        if ($data['parent_id'] === 'null') {
            $data['parent_id'] = null;
        }

        try {
            $database->table('sections')->update($id, $data);
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * Section deleting.
     *
     * @param int $id
     * @param Db $database
     * @return bool
     */
    public function deleteSection (int $id, Db $database): bool
    {
        try {
            $database->table('sections')->delete($id);
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

        return true;
    }
}
