<?php

class AgencesActiveEnumerable extends Enumerable
{
    const TravelAgency = 'TravelAgency';
    const ServiceProvider = 'ServiceProvider';
}

class AgencesProfileStatusEnumerable extends Enumerable
{
    const Created = 'Created';
    const Verified = 'Verified';
    const Authorized = 'Authorized';
    const Blocked = 'Blocked';
    const Closed = 'Closed';
}

class AppTypeEnumerable extends Enumerable
{
    const FERRY = 'FERRY';
    const AVION = 'AVION';
}

class CurrencyEnumerable extends Enumerable
{
    const Eur = 'Eur';
    const DH = 'DH';
}

class DomainEnvEnumerable extends Enumerable
{
    const Test = 'Test';
    const Prod = 'Prod';
}

class DomainModeEnumerable extends Enumerable
{
    const Production = 'Production';
    const Maintenance = 'Maintenance';
}

class FlagEnumerable extends Enumerable
{
    const No = 'No';
    const Yes = 'Yes';
}

class ServiceTypeEnumerable extends Enumerable
{
    const Service = 'Service';
    const Popup = 'Popup';
}

class StatusEnumerable extends Enumerable
{
    const Inactive = 'Inactive';
    const Active = 'Active';
}

class PropertyValue extends CPropertyValue
{
    public static function enumListData($class, $assoc=true, $id=null, $name=null)
    {
        $class = new ReflectionClass($class);
        
        if ($class->getParentClass()->isAbstract() && $class->hasMethod('primaryKey')) { //active record class
            $model = Yii::createComponent($class->name);
            return CHtml::listData($model->getDbConnection()->createCommand()
                ->select(array($id, $name))
                ->from($model->tableName())
                ->order($name . ' ASC')
                ->queryAll(), $id, $name);
        }
        
        $values = array_map(array(__CLASS__, 'formatLabel'), $class->getConstants());
        
        if (false === $assoc) {
            return array_values($values);
        }
        
        return $class->getConstants();
    }
    
    public static function formatLabel($value)
    {
        return implode(' ', preg_split('/(?=[A-Z])/', $value, -1, PREG_SPLIT_NO_EMPTY));
    }

    public static function enumValue($class, $id)
    {
        if ($id === '' || $id === null || $id === false) {
            return '---';
        }
        $class = new ReflectionClass($class);
        $values = $class->getConstants();
        
        if (preg_match('/[0-9]+/', $id)) {
            $values = array_values($values);
            $id = isset($values[$id]) ? $values[$id] : '';
        }
        
        return self::formatLabel(CPropertyValue::ensureEnum($id, $class->name));
    }
}

class Enumerable extends CEnumerable
{
    
}
