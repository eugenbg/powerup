<?php

class Search {

    public function query($searchWords)
    {
        $criteria = new CDbCriteria();
        $criteria->join = '';
        $criteria->condition = '1 ';
        foreach ($searchWords as $word)
        {
            $alias = $word . '_item';
            $criteria->join .= "LEFT JOIN item AS $alias ON t.id = $alias.id ";
            $criteria->condition .= "AND $alias.search_data LIKE '%$word%' ";
        }
        $criteria->condition .= "AND p.status = 1";
        $criteria = $this->buildCriteria($criteria);
        $result = Item::model()->findAll($criteria);
        $result = $this->groupResult($result);
        $frontendCategories = array_keys($result);
        return $result;
    }

    public function buildCriteria($criteria)
    {
        $criteria->join .= <<<EOF
JOIN brand b ON b.id = t.brand_id
JOIN item_item_category iic ON iic.item_id = t.id
JOIN frontend_category_item_category fcic ON fcic.item_category_id = iic.item_category_id
JOIN product_item pi ON pi.item_id = t.id
JOIN product p ON pi.product_id = p.id
JOIN frontend_category fc ON fcic.frontend_category_id = fc.id
JOIN product_category pc ON p.category_id = pc.id AND fc.product_category_id = pc.id
LEFT JOIN series s ON t.series_id = s.id
LEFT JOIN series ss ON t.subseries_id = ss.id
EOF;
        $criteria->select = array(
            't.*',
            'fc.id as frontendCategoryId',
            'fc.title as frontendCategoryTitle'
        );
        return $criteria;
    }

    public function groupResult(array $result)
    {
        $return = array();
        foreach ($result as $item)
        {
            $return[$item->frontendCategoryTitle][] = $item;
        }
        return $return;
    }
}