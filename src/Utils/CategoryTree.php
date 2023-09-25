<?php

namespace App\Utils;

use App\Utils\AbstractClasses\CategoryTreeAbstract;

class CategoryTree extends CategoryTreeAbstract
{
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
