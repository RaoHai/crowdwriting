<?php
/**
 * model 的基类
 *
 *  Copyright(c) 2011-2012 by surgesoft. All rights reserved
 *
 * To contact the author write to {@link mailto:surgesoft@gmail.com}
 *
 * @author surgesoft
 * @version $Id: model.base.class.php 2012-01-06 16:06
 * @package model.base.class.php

 * 关于数据库封装的效率
 * 在渣电脑上不使用缓存直接查询，
 * 测试10,000条1对多的多表连接数据查询的耗时在8.2606220245361～8.4245231151581秒之间
 * 基本上是按照ACT AS TREE的算法来做
 * 期待更好的优化

 */
require_once( APPLICATION_PATH."/db.conn.php");
class ActiveRecord
{
    public $dao;
    public $json=array();
	public $firstmatch= array();
    protected $IsDbObj;
    protected $DataStruct;
    protected $verify;
    private $instance;
    protected $obj=array();

    private $QueryLine;
    private $isMultiQuery;
    //NFA
    private $Status;									//状态标记
    private $QueryType;							//查询类型
    private $QueryColum; 						//查询名称
    private $QueryColums = array(); 						//查询名称
    private $QueryTable;  						//查询表名
    private $QueryConstraint; 					//查询约束
    private $QueryConstraintOperators;  //约束运算符
    private $QueryConstraintValue;			//约束值
    private $StatusArr = array("Get"=>"select","Set"=>"update","New"=>"insert","Del"=>"DELETE");
    //表间关系
    public $one_to_one = array();
    public $one_to_many = array();
    public $many_to_many = array();
    protected $join_sql;

    public function  __construct($instance)
    {
        $this->dao=database::getInstance();
        $this->instance = $instance;
        $this->isMultiQuery = 0;
        global $_Struct;
        if(isset($_Struct[$instance]))
        {
            $this->IsDbObj = true;
            $this->DataStruct = $_Struct[$instance];
        }

        //	var_dump($this->DataStruct);
    }
    public function getresult()
    {
        //if(empty($this->obj)) echo "空";
        return $this->obj;
    }
    public function lockMutiQuery()
    {
        $this->isMultiQuery = 1;
    }
    public function unlockMutiQuery()
    {
        $this->isMultiQuery = 0;
    }
    public function MultiQuery()
    {
        $this->DAL($this->QueryLine);
    }
    public function preparesql($sql)
    {
        if(empty($this->QueryLine))
            $this->QueryLine = $sql;
        else
            $this->QueryLine .=" union ".$sql;
    }
    /**
     *	函数 Get(array QueryColums, array Constraints,array limit);
     *  QueryColums： 参数数组
     *	Constraints：约束数组，必须明确表示=,<,>
     *	例如，Get(array("ImageID","ImageName"),array("id=5","sex=男"));
     *
     **/
    public function Get($QueryColums,$Constraints,$limit,$order)
    {
        $this->QueryType="";
        $this->QueryColum="";
        $this->QueryConstraint="";
        $this->QueryConstraintOperators="=";
        $this->obj=array();
        if(empty($limit)) $limit=array(0,30);
        $sql = "select ";
        $instance = $this->instance;
        global $_Struct;
        $q;
		
        if($QueryColums=="all")
        {
            $q = "*";
            $this->QueryColums = $this->DataStruct;
        }
        else if($QueryColums == "count")
        {
            $q = "COUNT(*)";
            $limit =null;
            $this->QueryColums ="COUNT(*)";
        }
        else
        {
            $this->QueryColums = $QueryColums;
            $q;
            foreach($QueryColums as $query)
            {
                if(empty($q))
                    $q.="`{$instance}`.`{$query}` ";
                else
                    $q.=",`{$instance}`.`{$query}` ";
            }
        }
        $ins =  ucfirst($instance);
        $q.=",`{$instance}`.`{$ins}Id` ";
        $sql.="{$q} from  `{$instance }` {$this->join_sql}";

        $Con;
        foreach($Constraints as $Key)
        {
            $Key=str_replace("=","`='",$Key);
            $Key=str_replace("<","`<'",$Key);
            $Key=str_replace(">","`>'",$Key);

            if(empty($Con))
                $Con .="`{$instance}`.`{$Key}'";
            else
                $Con.=" and `{$instance}`.`{$Key}'";
        }
        if(!empty($Con))
            $sql .= " where {$Con}";
        if(isset($order))
            $sql.=" ORDER BY {$order}";
        if(isset($limit))
            $sql.=" limit {$limit[0]},{$limit[1]}";
        //	echo $sql;

        //echo $sql;
        if($this->isMultiQuery==0)
        {
            $this->DAL($sql);
            return $this->getresult();
        }
        else
            $this->preparesql($sql);
    }
    /**
     *	函数Set(array QueryColums, array Constraints);
     *  QueryColums： 参数数组，必须表示为键值对
     *	Constraints：约束数组，必须明确表示=,<,>
     *	例如，Get(array("ImageID","ImageName"),array("id=5","sex=男"));
     *
     **/

    public function Set($QueryColums,$Constraints)
    {
        $this->QueryType="";
        $this->QueryColum="";
        $this->QueryConstraint="";
        $this->QueryConstraintOperators="=";
        $this->obj=array();
        $instance = $this->instance;
        $sql = "update {$instance} set";
        $query;
        foreach($QueryColums as $Key=>$Value)
        {
            $Value = rawurlencode($Value);
            if(empty($query))
                $query.="`{$instance}`.`{$Key}`='{$Value}'";
            else
                $query.=",`{$instance}`.`{$Key}`='{$Value}'";
        }
        $sql .="{$query} where ";
        foreach($Constraints as $Key)
        {
            $Key=str_replace("=","`='",$Key);
            $Key=str_replace("<","`<'",$Key);
            $Key=str_replace(">","`>'",$Key);
            if(empty($Con))
                $Con .="`{$instance}`.`{$Key}'";
            else
                $Con.=" and `{$instance}`.`{$Key}'";
        }
        $sql .= $Con;
        //	echo $sql;
        if($this->isMultiQuery==0)
        {
            $this->DAL($sql);
        }
        else
            $this->preparesql($sql);

    }
    public function Del($Constraints)
    {
        $this->QueryType="";
        $this->QueryColum="";
        $this->QueryConstraint="";
        $this->QueryConstraintOperators="=";
        $this->obj=array();
        $instance = $this->instance;
        $sql = "DELETE from {$instance} where ";
        $Con;
        foreach($Constraints as $Key)
        {
            $Key=str_replace("=","`='",$Key);
            $Key=str_replace("<","`<'",$Key);
            $Key=str_replace(">","`>'",$Key);
            if(empty($Con))
                $Con .="`{$instance}`.`{$Key}'";
            else
                $Con.=" and `{$instance}`.`{$Key}'";
        }
        $sql .= $Con;
        if($this->isMultiQuery==0)
        {
            $this->DAL($sql);
        }
        else
            $this->preparesql($sql);

    }
    /**
     *
     *	数据库调用。
     *	实现类似于Get_AAA_By_BBB的方法。
     *
     **/
    public function __call($FuncName,$arg)
    {
        if($this->IsDbObj)
        {

            $instruct =  explode('_',$FuncName);
            //echo $FuncName;
            //这部分应该是在模拟一个确定性有穷自动机进行SQL的自动生成
            //但是不知道实现是否标准。。。
            //反正就是这个意思。。
            $this->Status=0;
            $this->QueryType="";
            $this->QueryColum="";
            $this->QueryConstraint="";
            $this->QueryConstraintOperators="=";
            $this->obj=array();
            foreach ($instruct as $value)
            {
                //	echo $value;
                if(!$this->state_next($value) )
                {
                    //echo "语法错误";
                    break;
                }
                //else echo "成功接收|";

            }

            //var_dump($instruct);
            if($this->Status==99||$this->Status==4)//接收成功
            {
                //echo "全部接收成功>>>";
                //处理多表
                $instance = $this->instance;
                switch($this->QueryType){
                case "select":
                    foreach($this->one_to_one as $otherlabel)
                    {
                        $this->QueryColum .=",`".$otherlabel[1].'`.* ';
                    }
                    $sql = $this->QueryType." {$this->QueryColum} from `{$instance}`  {$this->join_sql} where `{$instance }`.`{$this->QueryConstraint}` {$this->QueryConstraintOperators}'".$arg[0]."'";
                    break;
                case "update":
                    if(!empty($this->verify)) $check=" and `".$this->verify."` ='".$_SESSION['USERID']."'";
                    $sql = $this->QueryType." `".$instance."` set ".$this->QueryColum." = '".$arg[1]."' where `".$this->QueryConstraint."` {$this->QueryConstraintOperators} '".$arg[0]."'".$check;
                    break;
                case "insert":
                    $list = implode(",",$this->DataStruct);
                    $argvalue="'".implode("','",$arg[0])."'";
                    $sql = "insert into `".$this->instance."`(".$list.") VALUES(".$argvalue.")";
                    break;
                case "DELETE":
                    $sql = $this->QueryType." from `{$instance }` where  `{$instance}`.`{$this->QueryConstraint}` ='".$arg[0]."'";
                    //echo $sql ;
                    break;
                }
                if($this->isMultiQuery==0)
                {
                    $this->DAL($sql);
                }
                else
                    $this->preparesql($sql);


            }
            else
            {
                //echo "语法错误：".$FuncName;
            }
        }
        else
        {
            echo __CLASS__.":访问错误的函数:".$FuncName."</br>该对象不是数据库相关对象";
        }

    }
    /* 数据库对象的抽象 
     *  其实也就是只是一次去冗余的封装而已。。
     *  把join出来的表根据重复项和从属关系
     *  分散到数组的各个键值
     *	2012-02-03，现在数据封装到对象中去了。。。
     */
    private function DAL($sql)
    {
        $this->obj = array();
        $this->json=array();
		$this->firstmatch=array();
        $this->dao->fetch($sql);
		
        if($this->QueryColums=="COUNT(*)")
        {
            $re = $this->dao->getRow();
            $this->obj = $re["COUNT(*)"];
            return;
        }
        while($list = $this->dao->getRow () )
        {

            //$echoid =$arg[0];			
            //echo "!!".$list["UserId"]."!!";
            $idset = ucfirst($this->instance)."Id" ;
            $currentid =  $list[$idset];

            if(!isset($this->obj[$currentid]))
            {
                $this->obj[$currentid] = new stdClass();
                //一对一数据封装
                foreach($this->one_to_one as $otherlabel)
                {

                    $n = $otherlabel[1];
                    //$this->obj[$currentid]->$n = new stdClass();
                    global $_Struct;
                    foreach($_Struct[$n] as $key)
                    {
                        $name = $n.".".$key;
                        $this->obj[$currentid]->$name = rawurldecode($list[$key]);
                    }
                }
            }
            $this->obj[$currentid]->$idset=$currentid;
            foreach($this->QueryColums as $key)
            {
                $this->obj[$currentid]->$key =  rawurldecode($list[$key]);
            }
			if(empty($this->firstmatch))
			{
				$this->firstmatch = $this->obj[$currentid];
				$this->firstmatch->$idset = $currentid;
			}
            $this->json[]=$this->obj[$currentid];

        }




    }
    /**
     *
     *
     *
     **/

    private function state_next($letter)
    {

        if(empty($this->QueryType) ) //初始状态
        {
            if(isset($this->StatusArr[$letter]))
            {
                $this->QueryType= $this->StatusArr[$letter];
                $this->Status = 1;
                if($this->QueryType == "insert") 	$this->Status = 99;
                return true;
            }
            else return false;
        }
        else
        {
            switch($this->QueryType)
            {
            case "select":
            case "update":
                switch($this->Status)
                {
                case 1:
                    if($letter=="By") 
                    {
                        if(empty($this->QueryColum))
                        {
                            $this->QueryColum ="*";
                            $this->QueryColums = $this->DataStruct;
                        }	
                        $this->Status=3;
                    }
                    else
                    {
                        if($letter=="ALL") 
                        {
                            $this->QueryColum ="*";
                            $this->QueryColums = $this->DataStruct;
                        }
                        else 
                        {
                            $this->QueryColums[]= $letter;
                            if(!empty($this->QueryColum)) $this->QueryColum .=", `".$this->instance."`.`".$letter."`";
                            else
                            {
                                if($this->QueryType=="select") $this->QueryColum =" `".$this->instance."`.`".ucfirst($this->instance)."Id` , `".$this->instance."`.`".$letter."`";
                                else $this->QueryColum ="`".$this->instance."`.`".$letter."`";
                            }
                        }
                        $this->Status=1;
                    }
                    return true;
                    break;
                case 2:
                    if($letter=="By") $this->Status=3;
                    else return false;
                    return true;
                    break;
                case 3:
                    $this->QueryConstraint = $letter;
                    $this->Status=4;
                    return true;
                    break;
                case 4:
                    if($letter=="M") $this->QueryConstraintOperators=">";
                    elseif($letter=="L") $this->QueryConstraintOperators="<";
                    else return false;
                    $this->Status=99;
                    return true;
                    break;
                }
                break;
            case "DELETE":
                switch($this->Status)
                {
                case 1:
                    if($letter=="By") $this->Status=2;
                    else return false;
                    return true;
                    break;
                case 2:
                    $this->QueryConstraint = $letter;
                    $this->Status=99;
                    return true;
                    break;
                }
                break;



            }

        }

    }
    /*
     *表间关系处理
     *分别有：
     *	 一对一关系
     *	一对多关系
     *   （多对多关系一般会借助一张连接表来实现，解决方法参照RoR，尝试查找一个名为$othermodel_$instance 的表）
     *	
     *   表间关系的定义需要双向定义。
     *   例如table1 与table2是一对一关系，
     *   则需要在table1中定义 has_one("table2")
     *   并同时在table2中定义 belongs_to("table1")
     *   才可以正常进行查询操作。
     *   若是只定义table1的has_one而没用定义table2的 belongs_to
     *   将只能在table1中查询到table2，
     *   而不能从table2中查询到table1.
     *   当然你可以纯手动- -
     *	2012-01-30
     *	突然发现join效率低下。
     *	所以这部分应该要重写吧
     */
    public function has_one($mykey,$othermodel,$foreignkey)
    {
        $arr = array($mykey,$othermodel,$foreignkey);
        array_push($this->one_to_one,$arr);
        $this->join_sql.="INNER JOIN  `{$othermodel}` ON  `{$this->instance}`.`{$mykey}` =  `{$othermodel}`.`{$foreignkey}` ";
    }
    public function has_many($othermodel,$foreignkey)
    {
        //if(empty($this->one_to_many)) echo "empty!!";
        $arr=array($othermodel,$foreignkey);
        array_push($this->one_to_many,$arr);
        //var_dump($this->one_to_many);
        //$this->join_sql.="LEFT JOIN  `{$othermodel}` ON  `{$this->instance}`.`{$this->instance}ID` =  `{$othermodel}`.`{$foreignkey}` ";
        //echo 	$this->join_sql;
    }

    public function belongs_to($othermodel,$foreignkey)
    {
        $arr=array($othermodel,$foreignkey);
        array_push($this->one_to_many,$arr);
        $this->join_sql.="LEFT JOIN  `{$othermodel}` ON  `{$this->instance}`.`{$this->instance}ID` =  `{$othermodel}`.`{$foreignkey}` ";
    }
}

