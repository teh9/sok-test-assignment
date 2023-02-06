<?php

namespace application\lib;

class TreeBuilder
{
    /**
     * Sorting array $sections and rewriting it by conditions using another array $itemsByReference.
     *
     * @param array $sections
     * @return array
     */
    public function buildTree (array $sections): array
    {
        foreach($sections as &$item) {
            $itemsByReference[$item['id']] = &$item;
        }

        unset($item);

        // Set the items as children of the relevant parent item
        foreach($sections as $key => &$item)  {
            if ($item['parent_id'] && isset($itemsByReference[$item['parent_id']])) {
                $itemsByReference[$item['parent_id']]['children'][] = &$item;
                unset($sections[$key]);
            }
        }

        return $sections;
    }

    /**
     * Rendering tree using recursive method.
     *
     * @param $tree
     * @return string
     */
    public function renderTree ($tree): string
    {
        $html = '<ul class="tree ps-0">';

        foreach ($tree as $branch) {
            $html .= '<li>';
            $html .= '<a href="/section/'.$branch['id'].'">'.$branch['name'].'</a>';
            $html .= ' - <a class="badge bg-danger text-decoration-none" href="/delete/'.$branch['id'].'">Delete</a>';
            if (isset($branch['children'])) {
                $html .= $this->renderTree($branch['children']);
            }
            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
