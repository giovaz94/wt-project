<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductTypology]].
 *
 * @see ProductTypology
 */
class ProductTypologyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProductTypology[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProductTypology|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
