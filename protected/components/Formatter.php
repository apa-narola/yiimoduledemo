<?php

class Formatter extends CFormatter
{
    
    private static $_pluralRules = array(
        '/(m)ove$/i' => '\1oves',
        '/(f)oot$/i' => '\1eet',
        '/(c)hild$/i' => '\1hildren',
        '/(h)uman$/i' => '\1umans',
        '/(m)an$/i' => '\1en',
        '/(s)taff$/i' => '\1taff',
        '/(t)ooth$/i' => '\1eeth',
        '/(p)erson$/i' => '\1eople',
        '/([m|l])ouse$/i' => '\1ice',
        '/(x|ch|ss|sh|us|as|is|os)$/i' => '\1es',
        '/([^aeiouy]|qu)y$/i' => '\1ies',
        '/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
        '/(shea|lea|loa|thie)f$/i' => '\1ves',
        '/([ti])um$/i' => '\1a',
        '/(tomat|potat|ech|her|vet)o$/i' => '\1oes',
        '/(bu)s$/i' => '\1ses',
        '/(ax|test)is$/i' => '\1es',
        '/s$/' => 's',
    );
    
    private static $_singularRules = array(
        '/(quiz)zes$/i' => '\\1',
        '/(matr)ices$/i' => '\\1ix',
        '/(vert|ind)ices$/i' => '\\1ex',
        '/^(ox)en/i' => '\\1',
        '/(alias|status)es$/i' => '\\1',
        '/([octop|vir])i$/i' => '\\1us',
        '/(cris|ax|test)es$/i' => '\\1is',
        '/(shoe)s$/i' => '\\1',
        '/(o)es$/i' => '\\1',
        '/(bus)es$/i' => '\\1',
        '/([m|l])ice$/i' => '\\1ouse',
        '/(x|ch|ss|sh)es$/i' => '\\1',
        '/(m)ovies$/i' => '\\1ovie',
        '/(s)eries$/i' => '\\1eries',
        '/([^aeiouy]|qu)ies$/i' => '\\1y',
        '/([lr])ves$/i' => '\\1f',
        '/(tive)s$/i' => '\\1',
        '/(hive)s$/i' => '\\1',
        '/([^f])ves$/i' => '\\1fe',
        '/(^analy)ses$/i' => '\\1sis',
        '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\\1\\2sis',
        '/([ti])a$/i' => '\\1um',
        '/(n)ews$/i' => '\\1ews',
        '/s$/i' => ''
    );
    
    private static $_irregularWords = array(
        'person' => 'people',
        'man' => 'men',
        'child' => 'children',
        'sex' => 'sexes',
        'move' => 'moves'
    );
    
    private static $_ignoreWords = array(
        'equipment',
        'information',
        'rice',
        'money',
        'species',
        'series',
        'fish',
        'sheep',
        'press',
        'sms',
    );

    public function __call($name, $parameters)
    {
        if (method_exists($this, 'format' . $name)) {
            return call_user_func_array(array($this, 'format' . $name), $parameters);
        } else if (function_exists($name)) {
            return call_user_func_array($name, $parameters);
        }

        return parent::__call($name, $parameters);
    }

    public function chain($value)
    {
        return new ModifingerChain($value);
    }

    public function truncate($value, $length, $type = TruncateType::Character)
    {
        switch (CPropertyValue::ensureEnum($type, TruncateType)) {
            case TruncateType::Paragraph:
                return $this->truncateParagraph($value, $length);
            case TruncateType::Word:
                return $this->truncateWord($value, $length);
            case TruncateType::Character:
            default:
                return $this->truncateCharacter($value, $length);
        }
    }

    public function truncateCharacter($value, $length)
    {
        if ($value === '' || $length === 0) {
            return '';
        }

        if (mb_strlen($value, 'UTF-8') > $length) {
            $value = preg_replace('/\s+?(\S+)?$/u', '', mb_substr($value, 0, $length + 1, 'UTF-8'));
            return mb_substr($value, 0, $length, 'UTF-8');
        }

        return $value;
    }

    public function truncateParagraph($value, $length)
    {
        if ($value === '' || $length === 0) {
            return '';
        }

        $value = array_filter(array_map('trim', mb_split(PHP_EOL, $value)));
        return implode(PHP_EOL . PHP_EOL, array_slice($value, 0, $length));
    }

    public function truncateWord($value, $length, $min = 0)
    {
        if ($length == 0) {
            return '';
        }

        $values = array_filter(preg_split('/\s+/u', $value), function($item) use ($min) {
            return mb_strlen($item, 'UTF-8') > $min;
        });

        $indisies = array_keys($values);
        if (isset($indisies[$length])) {
            return implode(' ', array_slice(preg_split('/\s+/u', $value), 0, $indisies[$length]));
        }

        return $value;
    }

    public function formatEncode($value)
    {
        return CHtml::encode($value);
    }
    
    function formatSingular($value)
    {
        if (empty($value)) {
            return '';
        }

        $lower_word =  strtolower($value);
        foreach (self::$_ignoreWords as $ignore_word) {
            if (substr($lower_word, (-1 * strlen($ignore_word))) == $ignore_word) {
                return $value;
            }
        }

        foreach (self::$_irregularWords as $singular_word => $plural_word) {
            if (preg_match('/(' . $plural_word . ')$/i', $value, $arr)) {
                return preg_replace('/(' . $plural_word . ')$/i', substr($arr[0], 0, 1) . substr($singular_word, 1), $value);
            }
        }

        foreach (self::$_singularRules as $rule => $replacement) {
            if (preg_match($rule, $value)) {
                return preg_replace($rule, $replacement, $value);
            }
        }

        return $value;
    }
    
    public function formatPlural($value)
    {
        foreach (self::$_pluralRules as $rule => $replacement) {
            if (preg_match($rule, $value))
                return preg_replace($rule, $replacement, $value);
        }
        return $value . 's';
    }

}

class TruncateType extends CEnumerable
{
    const Character = 'Character';
    const Word = 'Word';
    const Paragraph = 'Paragraph';
}

class ModifingerChain
{

    private $_value;

    public function __call($name, $parameters)
    {
        array_unshift($parameters, $this->_value);
        $this->_value = call_user_func_array(array(Yii::app()->format, $name), $parameters);
        return $this;
    }

    public function __construct($value)
    {
        $this->_value = $value;
    }
    
    public function flush()
    {
        return $this->_value;
    }

    public function __toString()
    {
        return $this->_value;
    }

}
