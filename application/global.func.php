<?php
function getmicrotime(){ 
	list($usec, $sec) = explode(" ",microtime()); 
	return ((float)$usec + (float)$sec); 
} 
function loadser()
{
	$fp = fopen (APPLICATION_PATH."/lib/aclserialize.ser","r");
	$content = fread ($fp,filesize (APPLICATION_PATH."/lib/aclserialize.ser"));
	fclose($fp);
	$obj = unserialize($content);
	return $obj;
}
function json($str)
{
   header('Content-type: text/json');
   echo json_encode($str);
}
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

function utf8_substr($str,$start) { 
    /*
    UTF-8 version of substr(), for people who can't use mb_substr() like me.
    Length is not the count of Bytes, but the count of UTF-8 Characters
    
    Author: Windix Feng
    Bug report to: windix(AT)gmail.com, http://www.douzi.org 

    - History -
    1.0 2004-02-01 Initial Version
    2.0 2004-02-01 Use PREG instead of STRCMP and cycles, SPEED UP!
    */ 

    preg_match_all("/[x01-x7f]|[xc2-xdf][x80-xbf]|xe0[xa0-xbf][x80-xbf]|[xe1-xef][x80-xbf][x80-xbf]|xf0[x90-xbf][x80-xbf][x80-xbf]|[xf1-xf7][x80-xbf][x80-xbf][x80-xbf]/", $str, $ar);  

    if(func_num_args() >= 3) { 
    	$end = func_get_arg(2); 
    	return join("",array_slice($ar[0],$start,$end)); 
    } else { 
    	return join("",array_slice($ar[0],$start)); 
    }
}
function page_creator($url,$curpage,$totalcount,$numperpage)
{
	$totalpage=ceil($totalcount/$numperpage);
	if($curpage>$totalpage+1) return "";
	$begin = (floor($curpage/$numperpage))*$numperpage;
	if($begin==0)$begin=1;
	$end= (floor($curpage/$numperpage)+1)*$numperpage;
	$end = $end<$totalpage+1?$end:$totalpage;
	$out = '<ul class="pagenav">';
	$pre = $begin-1;
	if($pre>0)
		$out.="<li><a href='{$url}&page={$pre}'><</a></li>";
	for($i=$begin;$i<=$end;$i++)
	{
		if($i==$curpage) $cls = "class='current'"; else $cls="";
		$out.="<li {$cls}><a  href='{$url}&page={$i}'>{$i}</a></li>";
	}
	$next = $end + 1;
	if($next<$totalpage)
		$out.="<li><a href='{$url}&page={$end}'>></a></li>";
	$out.="</ul>";
	return $out;
}
function __autoload($classname)
{
	include(APPLICATION_PATH."/controllers/controller.{$classname}.class.php");
}
/*
 * 注册全局变量
 */
function register_global_var($name,$value){
	define($name,$value);
}
/*
 * URL生成器
 */
function url_generator($c,$a,$p){
	if(SHORT_URI){
		return "/".$c."/".$a."/".$p;
	}else{
		return "/?m=".$c."&a=".$a."&p=".$p;
	}
}

  	/*
     * document elements generator:
     */
    function nav_creator($i){
        //$this->set_refer
        $columns = new columns();
        $columns->Get("all");
        if(isset($i)){
            $columns->Get("all",array("parentColumnsId=1"));
        }
      
        if(_MODULE == 'columns'){
            $_CURRENT_ID = _PARAM;
        }else {
            $childcolumn = new childcolumns();
            $childcolumn->Get_By_ChildcolumnsId(_PARAM);
            $_CURRENT_ID = $childcolumn->parentColumns;
        }
        $index_page_active = "";
        if(_MODULE == 'index') $index_page_active = "class='active'";
        $nav ="<li ".$index_page_active."><a href='/'>首页</a></li>".PHP_EOL;


        foreach($columns as $co){
        	$current_active = "";
        	if((_MODULE=='columns'|| _MODULE == 'childcolumns') && $co->ColumnsId==$_CURRENT_ID) $current_active = "class='active'";
            $nav .= '<li '.$current_active.'><a href="'.url_generator("columns","index", $co->ColumnsId).'">'. $co->columnsName .'</a></li>'.PHP_EOL;
        }
        return $nav;
    }
    function child_creator(){
     
        $childcolumns = new childcolumns();
        $childcolumns->Get_By_parentColumns(_PARAM);
        foreach($childcolumns as $co){
            $child .="<li><a href='".url_generator("childcolumns","index",$co->ChildcolumnsId)."'>".$co->childColumnsName.'</a></li>';
        }
        return $child;

    }
    function category(){
        $catalog = new catalog();
        $catalog->Get('all');
        foreach($catalog as $c){
            $category.='<li>'.$c->catalogName.'</li>';
        }
        return $category;
    }
    function bread_crumb(){
       
        if(_MODULE=='index') return '';
        if(_MODULE=='columns'){
            $column = new columns();
            $column->Get_By_ColumnsId(_PARAM);
            $bread_crumb .= " <span class='divider'>>></span><li class='active'><a href='".url_generator("columns","index",_PARAM)."'>".$column->columnsName."</a></li>";
        }
        if(_MODULE=='childcolumns'){
            $childcolumn = new childcolumns();
            $childcolumn->Get_By_ChildcolumnsId(_PARAM);
            $column = new columns();
            $column->Get_By_ColumnsId($childcolumn->parentColumns);
            $bread_crumb .= " <span class='divider'>>></span><li><a href='".url_generator("columns","index",$column->ColumnsId)."'>".$column->columnsName."</a></li>";

            $bread_crumb .= " <span class='divider'>>></span><li class='active'><a href='".url_generator("childcolumns","index",$childcolumn->ChildcolumnsId)."'>".$childcolumn->childColumnsName."</a></li>";
            
        }
        return $bread_crumb;
    }
    function footer_creator(){
        $line = '<p>浙ICP备11000033号 Copyright©浙江瑞诺泰富科技有限公司 版权所有</p>';
        $line.='<p>电话：0571-887649017  传真：0571-87648093  邮箱：rntf@rntaifu.com</p>';
        return $line;
    }
    

?>
