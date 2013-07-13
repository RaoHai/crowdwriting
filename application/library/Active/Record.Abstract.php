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

	public function getFromRequest($_PUT)
	{
		$this->id = $_PUT['id'];
		foreach ($this->type as $key => $value) {
			if ($v = $_PUT[$key]) {
				$this->$key = $v;
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
			$condition = $conditions;
		} 			

		if (isset($limit)) {
			$limitQuery = $limit;
		} else {
			$limitQuery = "0, 30";
		}

		if (isset($sort)) {
			$sortQuery = "ORDER BY $sort";
		}


		$sql = "$queryCommand $queryColumns FROM `$table` WHERE $condition $sortQuery LIMIT $limitQuery;";
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
					$val = empty($this->$key) ? '\'\'' : $this->$key;
					array_push($insertColumns, $key);
					array_push($insertValues, $val);
				}
			}
			$insert = join(',',$insertColumns);
			$vals = join('\',\'',$insertValues);
			$sql = $savecolumns.$insert.") VALUES('".$vals."');";
			$this->db->query($sql);
			$this->$primary = mysql_insert_id();
	}
	public function update($conditions)
	{
		$instance = $this->instance;
		$primary = $instance.'Id';
		if (empty($this->id)) {
			return -1;
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

		if (is_numeric($conditions)) {
			$condition = "WHERE `$instance`.`$primary` = $condition";
		} else {
			$condition = "WHERE $conditions";
		}

		$sql = $savecolumns.join(",", $updateColumns).$condition;
		$this->db->query($sql);
		
	}

}