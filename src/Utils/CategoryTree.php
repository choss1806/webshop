<?php

namespace App\Utils;

use App\Utils\AbstractClasses\CategoryTreeAbstract;


class CategoryTree extends CategoryTreeAbstract
{
    public function getCategoryListAndParent(int $id): string
    {
    }

    public function getCategoryList(array $categories_array)
    {
    }

    public function getMainParent(int $id): array
    {
        $key = array_search($id, array_column($this->categoriesArrayFromDb, 'id'));
        if ($this->categoriesArrayFromDb[$key]['parent_id'] != null) {
            return $this->getMainParent($this->categoriesArrayFromDb[$key]['parent_id']);
        } else {
            return [
                'id' => $this->categoriesArrayFromDb[$key]['id'],
                'name' => $this->categoriesArrayFromDb[$key]['name']
            ];
        }
    }


    public function getChildIds(int $parent): array
    {
        static $ids = [];
        foreach ($this->categoriesArrayFromDb as $val) {
            if ($val['parent_id'] == $parent) {
                $ids[] = $val['id'] . ',';
                $this->getChildIds($val['id']);
            }
        }
        return $ids;
    }
}
