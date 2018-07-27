<?php

namespace libs;

abstract class SqlBuilder
{	
	private $dsn;
	private $user;
	private $pass;
	private $dbh;

	private $sql;
	private $fields;
	private $tables;
	private $order;
	private $limit;
	private $group;
	private $where;
	private $having;
	private $params;
	private $returning;
	private $queryType;
	/*Не придумал как по полям забрать параметры 
	 *ну поля то заквотированы уже получаються
	 *Поэтому часть SET буду ставить прямиком в методе UPDATE
	 * а в билдере UPDATE просто забирать его
	 */
	private $setPart;

	private $namesValidator;
	private $intValidator;
	
	private $operationValidator;
	private $operandValidator;
	private $strValidator;

	public function __construct()
	{
		$this->clear();
	}

	protected abstract function quote($str);

	public function clear()
	{
		$this->sql='';
		$this->fields=array();
		$this->method='';
		$this->tables='';
		$this->order='';
		$this->limit='';
		$this->group='';
		$this->where='';
		$this->having='';
		$this->params=array();
		$this->queryType=0;
		$this->setPart='';
		$this->returning='';

		$this->operationValidator=new \validators\vArrContains();
		$this->operandValidator=new \validators\vArrContains();
		$this->operationValidator->setArr(array('=','!=','>','<','LIKE','IS NULL','IS NOT NULL'));
		$this->operandValidator->setArr(array('AND','OR'));
		
		$this->strValidator=new \validators\vStrLength();

		$this->namesValidator=new \validators\vStrExp();
		$this->namesValidator->setMin(2)->setMax(300);
		$this->namesValidator->setExp('/[^A-Za-z0-9_.\s:]+/');

		$this->intValidator = new \validators\vIntMoreZero();
	}
	
	public function lastInsertId()
	{
		return $this->dbh->lastInsertId(); 
	}

	public function exec()
	{		
		$this->buildSql();
		$this->strValidator->setMin(10)->isValid($this->sql);
		$stmt = $this->dbh->prepare($this->sql);
		foreach ($this->params as $key=>$val)
		{
			/* Вот тут нужно быть окуратным потому что функция как оказываеться берет ссылку 			
			 * и если сделать вот так $stmt->bindParam($key, $val);
			 * получим соответствующий треш где значение всех параметров будут как у последнего
			 */
			$stmt->bindParam($key, $this->params[$key]);
		}
		$stmresult = $stmt->execute();
		if (false === $stmresult)
		{
			throw new \exceptions\SqlExecuteException(SQL_EXECUTION_ERROR.' '.$this->sql);
		}
		else
		{
			if(1 ===$this->queryType)
			{
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			}
			else
			{
				$result =$stmresult;
			}			
			$stmt->closeCursor();
			$this->clear();
			return $result;
		}		
	}

	
	protected function connect()
	{
			$this->dbh = new \PDO($this->getDsn(), $this->getUser(), $this->getPassword());
	}
//-------------------getters&setters----------------------------------------
	public function getDsn()
	{
		return $this->dsn;
	}

	public function setDsn($dsn)
	{
		$this->dsn = $dsn;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function getPassword()
	{
		return $this->pass;
	}

	public function setPassword($password)
	{
		$this->pass = $password;
	}

	public function getSql()
	{
		return $this->sql;
	}

//--------------------QUERIES----------------------------------------------
	public function select($fields=array())
	{		
		$this->queryType=1;		
		foreach ($fields as $field)
		{
			$this->setField($field);
		}

		return $this;		
	}

	public function insert($columns)	
	{
		$this->queryType=2;		
		foreach ($columns as $key=>$val)
		{			
			$this->setField($key);
			$this->addParam($key,$val);
		}

		return $this;		
	}

	public function update($columns)	
	{				
		$this->queryType=3;
		$strFields='';
		foreach ($columns as $key=>$val)
		{			
			$field = $this->addField($key);
			$param = $this->addParam($key,$val);
			$strFields.=' '.$field.'='.$param.',';
		}
		$this->setPart.=substr($strFields, 0, -1);
		return $this;		
	}

	public function delete()	
	{
		$this->queryType=4;
		
		return $this;		
	}
//--------------------------PARAMS--------------------------------------------
	public function setParam($params)
	{
		foreach ($params as $key=>$val)
		{
			$this->addParam($key,$val);
		}
		return $this;
	}

	private function addParam($field, $val)
		{
			$paramName = $this->prepareParam($field);
			$this->params[$paramName] = $val;
			return $paramName;
		}
	
	private function prepareParam($field)
		{
			$this->namesValidator->isValid($field);
			$param=str_replace(' ','',$field);
			$param=':'.str_replace('.','',$field);
			return $param;
		}	
//--------------------------FIELDS--------------------------------------------
	public function distinct($field)
	{
		$field='DISTINCT '.$this->prepareField($field);
		array_unshift($this->fields, $field);
		return $this;
	}

	public function setField($field)
	{
		$this->addField($field);
		return $this;
	}
	
	private function prepareField($field)
	{
    $split = preg_split("/ AS /",$field);
    $result='';
    if (1<count($split))
    {
      $result .= $this->prepareFieldDot($split[0]);
      $result .= ' AS ' . $this->quote($split[1]);
    } 
    else
    {
     $result .= $this->prepareFieldDot($field); 
    }
    return $result;
	}
  
  private function prepareFieldDot($field)
  {
    $this->namesValidator->isValid($field);
		$result='';
		$split = preg_split("/[.]/",$field);		
		if (1<count($split))
		{
			$result = $this->prepareTableName($split[0]).'.'.$this->quote($split[1]);
		}
		else
		{
			$result = $this->quote($field);
		}
		return $result;    
  }

	private function addField($field)
	{
		$field = $this->prepareField($field);
		array_push($this->fields, $field);
		return $field;
	}
//--------------------------TABLES--------------------------------------------
	protected function prepareTableName($name)
	{
		return $name;
	}

	private function addTable($table,$separator=', ')
	{		
		if (0 !== strlen($this->tables))		
		{
			$this->tables.=$separator;
		}
		$this->tables.=$table;
	}

	public function setTable($name)
	{
		if(is_array($name))
		{
			foreach($name as $table)
			{
				$this->namesValidator->isValid($table);
				$this->addTable($this->prepareTableName($table));
			}
		}
		else
		{
			$this->namesValidator->isValid($name);
			$this->addTable($this->prepareTableName($name));			
		}		
		return $this;
	}

//-----------------------JOINS-------------------------------------------------

	public function join($table,$field1,$field2)
	{		
		$this->namesValidator->isValid($table);
		$this->namesValidator->isValid($field1);
		$this->namesValidator->isValid($field2);

		$join='INNER JOIN '.$this->prepareTableName($table).' ON '
				.$this->prepareField($field1).'='.$this->prepareField($field2);
		$this->addTable($join,' ');
		return $this;
	}

	public function leftJoin($table,$field1,$field2)
	{
		$this->namesValidator->isValid($table);
		$this->namesValidator->isValid($field1);
		$this->namesValidator->isValid($field2);

		$join='LEFT OUTER JOIN '.$this->prepareTableName($table).' ON '
				.$this->prepareField($field1).'='.$this->prepareField($field2);
		$this->addTable($join,' ');
		return $this;
	}

	public function rightJoin($table,$field1,$field2)
	{
		$this->namesValidator->isValid($table);
		$this->namesValidator->isValid($field1);
		$this->namesValidator->isValid($field2);

		$join='RIGHT OUTER JOIN '.$this->prepareTableName($table).' ON '
				.$this->prepareField($field1).'='.$this->prepareField($field2);
		$this->addTable($join,' ');
		return $this;
	}

	public function crossJoin($table)
	{
		$join='CROSS JOIN '.$this->prepareTableName($table);
		$this->addTable($join,' ');
		return $this;
	}

	public function naturalJoin($table)
	{
		$join='NATURAL JOIN '.$this->prepareTableName($table);
		$this->addTable($join,' ');
		return $this;
	}
//----------------------------Order----------------------------------
	public function order($fields)
	{	
		$order='';	
		if (0 === strlen($this->order))
		{
			$order=' ORDER BY';
		}

		foreach ($fields as $field)
		{
			if (strpos($field, ' ') !== false)
			{
				$split = preg_split("/[\s]/",$field);
				$order.=' '.$this->prepareField($split[0]).' '.$split[1].',';
			}
			else
			{
				$order.=' '.$this->prepareField($field).',';
			}

		}
		$this->order.=substr($order, 0, -1);
		return $this;
	}
//----------------------------Group----------------------------------
	public function group($fields)
	{
		$group='';	
		if (0 === strlen($this->group))
		{
			$group=' GROUP BY';
		}

		foreach ($fields as $field)
		{
			$group.=' '.$this->prepareField($field).',';
		}
		$this->group.=substr($group, 0, -1);
		return $this;
	}
//----------------------------Limit----------------------------------
	public function limit($min,$max=false)
	{

		$this->intValidator->isValid($min);
		$this->limit.=' LIMIT '.$min;
		if(false !== $max)
		{
			$this->intValidator->isValid($max);
			$this->limit.=','.$max;
		}
		return $this;
	}
//----------------------------Where----------------------------------
	public function where($field,$operation,$param,$operand='')	
	{	
		$this->namesValidator->isValid($field);		
		$this->namesValidator->isValid($param);
		$this->operationValidator->isValid($operation);
		$where = '';
		if(0 === strlen($this->where))
		{
			$where .=' WHERE';
			$where .=' '.$this->prepareField($field).' '.$operation.' '.$param;
		}
		else
		{
			$this->operandValidator->isValid($operand);
			$where .=' '.$operand.' '.$this->prepareField($field).' '.$operation.' '.$param;	
		}		
		$this->where.=$where;
		
		return $this;
	}
//----------------------------Having----------------------------------
	public function having($field,$operation,$param,$operand='')
	{	
		$this->namesValidator->isValid($field);
		$this->namesValidator->isValid($substr($param,0,1));
		$this->operationValidator->isValid($operation);

		$having = '';
		if(0 === strlen($this->having))
		{
			$having .=' HAVING';
			$having .=' '.$this->prepareField($field).' '.$operation.' '.$param;
		}
		else
		{
			$this->operationValidator->isValid($operand);
			$having .=' '.$operand.' '.$this->prepareField($field).' '.$operation.' '.$param;	
		}		
		$this->having.=$having;
		
		return $this;
	}
//---------------------------RETURNING------------------------------------
	public function returning()
	{
		$this->returning=' RETURNING '.implode(", ", $this->fields);

		return $this;
	}
//---------------------------QueryBuild--------------------------------
	public function buildSql()
	{
		switch ($this->queryType) {
			case 1:
				if(0>=count($this->fields))
				{
					throw new ValidationException(EMPTY_FIELD_ERROR);
				}

				if(0>=strlen($this->tables))
				{
					throw new ValidationException(EMPTY_TABLE_ERROR);
				}

				$this->buildSelect();
				break;
			case 2:
				if(0>=count($this->fields))
				{
					throw new ValidationException(EMPTY_FIELD_ERROR);
				}

				if(0>=strlen($this->tables))
				{
					throw new ValidationException(EMPTY_TABLE_ERROR);
				}

				$this->buildInsert();
				break;
			case 3:
				if(0>=count($this->fields))
				{
					throw new ValidationException(EMPTY_FIELD_ERROR);
				}

				if(0>=strlen($this->tables))
				{
					throw new ValidationException(EMPTY_TABLE_ERROR);
				}

				$this->buildUpdate();
				break;
			case 4:
				if(0>=strlen($this->tables))
				{
					throw new ValidationException(EMPTY_TABLE_ERROR);
				}

				$this->buildDelete();
				break;
		}
		return $this;
	}

	public function buildSelect()
	{
		$this->sql = 'SELECT '.implode(", ", $this->fields).' FROM '.$this->tables;
		if (0<strlen($this->where))
		{
			$this->sql.=$this->where;			
		}

		if (0<strlen($this->group))
		{
			$this->sql.=$this->group;
			if (0<strlen($this->having))
			{
				$this->sql.=$this->having;			
			}			
		}

		if (0<strlen($this->order))
		{
			$this->sql.=$this->order;			
		}

		if (0<strlen($this->limit))	
		{
			$this->sql.=$this->limit;			
		}

		return $this;
	}

	public function buildInsert()
	{
		$this->sql = 'INSERT INTO '.$this->tables.' ('.implode(", ", $this->fields).') VALUES ('
		.implode(", ", array_keys($this->params)).')'.' '.$this->returning;		

		return $this;
	}

	public function buildUpdate()
	{
		$this->sql = 'UPDATE '.$this->tables.' SET '.$this->setPart.' ';
		
		if (0<strlen($this->where))
		{
			$this->sql.=$this->where;			
		}

		return $this;
	}

	public function buildDelete()
	{
		$this->sql = 'DELETE FROM '.$this->tables;
		
		if (0<strlen($this->where))
		{
			$this->sql.=$this->where;			
		}

		return $this;
	}


}
?>
