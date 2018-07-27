<?php

namespace libs;

class MysqlExecutor extends SqlBuilder 
{
    function __construct() {

        parent::__construct();

        $this->setDsn(MY_DSN);
        $this->setUser(DB_USER);
        $this->setPassword(DB_PASSWORD);
        
        $this->connect();
    }

    protected function quote($str)
    {
        return '`'.$str.'`';
	}

	protected function prepareTableName($table)
	{
		return $this->quote($table);
	}
}
?>
