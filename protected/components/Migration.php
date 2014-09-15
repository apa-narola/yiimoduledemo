<?php

class Migration extends CDbMigration
{
    private $_dbName;
    
    /**
     * Get database name
     * @return string
     */
    protected function getDbName()
    {
        if (null === $this->_dbName) {
            preg_match('/dbname\=(\w+)/', $this->getDbConnection()->connectionString, $matches);
            $this->_dbName = end($matches);
        }
        
        return $this->_dbName;
    }

    public function execute($sql, $params = array())
    {
        return parent::execute($sql, $params);
    }
}
