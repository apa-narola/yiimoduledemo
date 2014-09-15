<?php

Yii::import('application.models.Enums', true);

class ActiveRecord extends CActiveRecord
{
    public $titleField = 'id';
    
    public function getEntityLabel()
    {
        if (Yii::app()->controller->action->id === 'index') {
            $parts = explode('_', $this->entityName());
            $last = array_pop($parts);
            return ucwords(implode(' ', array_merge($parts, array(Yii::app()->format->formatPlural($last)))));
        } else if (Yii::app()->controller->action->id === 'view') {
            return ucwords(implode(' ', explode('_', $this->entityName()))) . ' ' . $this->getAttribute($this->titleField);
        }
        
        return ($this->getIsNewRecord() ? 'Create ' : 'Update ') 
                . ucwords(implode(' ', explode('_', $this->entityName())))
                . ($this->getIsNewRecord() ? '' : ' ' . $this->getAttribute($this->titleField));
    }
    
    public function getEntityLabelPlural()
    {
        $parts = explode('_', $this->entityName());
        $last = array_pop($parts);
        return ucwords(implode(' ', array_merge($parts, array(Yii::app()->format->formatPlural($last)))));
    }
    
    public function getEntityLabelSingular()
    {
        $parts = explode('_', $this->entityName());
        $last = array_pop($parts);
        return ucwords(implode(' ', array_merge($parts, array(Yii::app()->format->formatSingular($last)))));
    }
    
    public function entityName()
    {
        return $this->tableName();
    }
}
