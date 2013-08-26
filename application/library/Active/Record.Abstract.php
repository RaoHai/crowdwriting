<?php
class Active_Record_Abstract{
	protected $type ;
	protected $db;
	protected $instance;
	public function __construct($instanceName)
	{
		$this->type = new stdClass();
		$this->db = ezSQL_DB::getInstance();
		$this->instance = $instanceName;
	}

	public function typeMap($key, $value)
	{
		$this->type->$key = $value;
	}

	public function getMap()
	{
		return $this->type;
	}

	public function getFromRequest($PUT)
	{
		$this->id = $PUT['id'];
		foreach ($this->type as $key => $value) {
			if ($v = $PUT[$key]) {
				$this->$key = $v; 
			} elseif($value == 'datetime') {
				$this->$key = date('Y-m-d H:i:s');
			}
		}
	}
	public function find($columns, $conditions = NULL, $limit = NULL, $sort = NULL)
	{ 
		$table = $this->instance;
		$id = $table.'Id';
		$queryCommand = 'select';
		$queryColumns = '';
		if (is_numeric($columns)) {
			$queryColumns = '*';
			$sql = "$queryCommand $queryColumns from `$table` where `$table`.`$id` = $columns";
			return $this->db->cachedQuery('select', $table, $columns, $sql);
		}

		if ($columns == 'all') {
			$queryColumns = ' * ';
		} else {
			if (!is_array($columns)) {
				$columns = array($columns);
			}
			$queryColumns = '`'.$this->instance.'Id` ,`'.join('`,`', $columns).'`';
		}

		if (isset($conditions)) {
			$condition = 'WHERE' .$conditions;
		} 			

		if (isset($limit)) {
			$limitQuery = $limit;
		} else {
			$limitQuery = "0, 30";
		}

		if (isset($sort)) {
			$sortQuery = "ORDER BY $sort";
		}


		$sql = "$queryCommand $queryColumns FROM `$table` $condition $sortQuery LIMIT $limitQuery;";
		return $this->db->cachedQuery('select', $table, $queryColumns, $sql);
	}

	public function save()
	{
		$instance = $this->instance;
		$primary = $instance.'Id';

		$savecolumns = "INSERT INTO $instance(";
			$insertColumns = array();
			$insertValues = array();
			foreach ($this->type as $key => $value) {
				if ($key != $primary) {
					$val = empty($this->$key) ? '' : $this->$key;
					if (strpos($key,'Content')) {
						$val = rawurlencode($val);
					}
					array_push($insertColumns, $key);
					array_push($insertValues, $val);
				}
			}

			$insert = join(',',$insertColumns);
			$vals = join('\',\'',$insertValues);
			$sql = $savecolumns.$insert.") VALUES('".$vals."');";
			$this->db->query($sql);
			$this->id = $this->$primary = mysql_insert_id();
	}
	public function update($conditions)
	{
		$instance = $this->instance;
		$primary = $instance.'Id';
		if (empty($this->id)) {
			return "Error: Id is Empty!";
		}
		$savecolumns = "UPDATE $instance SET ";
		$condition;
		$updateColumns = array();

		foreach ($this->type as $key => $value) {
			if ($key != $primary && !empty($this->$key)) {
				$k = $key;
				$v = $this->$key;
				array_push($updateColumns, "`$key`='$v'");
			}
		}

		if (empty($conditions)) {
			$condition = $this->id;
			$condition = " WHERE `$instance`.`$primary` = $condition";
		} else {
			$condition = " WHERE $conditions";
		}

		$sql = $savecolumns.join(",", $updateColumns).$condition;
		$this->db->query($sql);
		return $this;
	}

}