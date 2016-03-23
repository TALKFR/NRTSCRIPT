<?php

namespace app\components;

use yii\validators\Validator;

class EitherValidator extends Validator {

    /**
     * @inheritdoc
     */
    public function validateAttributes($model, $attributes = null) {
        $labels = [];
        $values = [];
        $attributes = $this->attributes;
        foreach ($attributes as $attribute) {
            $labels[] = $model->getAttributeLabel($attribute);
            if (!empty($model->$attribute)) {
                $values[] = $model->$attribute;
            }
        }

        if (empty($values)) {
            $labels = '«' . implode('» ou «', $labels) . '»';
            foreach ($attributes as $attribute) {
                $this->addError($model, $attribute, "Le champs {$labels} est obligatoire");
            }
            return false;
        }
        return true;
    }

}
