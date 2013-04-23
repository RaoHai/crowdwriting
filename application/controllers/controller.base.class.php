<?php


/**
 * controller 的基类
 *
 * Copyright(c) 2011-2013 by surgesoft. All rights reserved
 *
 * To contact the author write to {@link mailto:surgesoft@gmail.com}
 *
 * @author surgesoft
 * @version $Id: controller.base.class.php 2012-01-06 16:06
 * @package controller
 * 控制器的模板编译参考了vemplator
 * 但是实现方法可能略有差异
 */
class ControllerBase implements Iterator
{
    public $firstmatch;
    public $items;
    private $json;
    private $model;
    protected $view;
    protected $TemplateFolder;
    protected $TemplateFile;
    protected $values;
    public function  __construct()
    {
        //$this->model = new ModelBase();
        $instance = get_class($this);
        require_once( APPLICATION_PATH."/controllers/active.record.class.php");
        $this->TemplateFolder= APPLICATION_PATH."/view/{$instance}/";
        $this->model = new ActiveRecord($instance);
        $this->instance = $instance;
    }
    public function has_one($mykey,$othermodel,$foreignkey)
    {
        $this->model->has_one($mykey,$othermodel,$foreignkey);
    }
    /*Impl iterator*/
    public function rewind() { reset($this->items); }
        public function current() { return current($this->items); }
        public function key() { return key($this->items); }
        public function next() { return next($this->items); }
        public function valid() { return ( $this->current() !== false ); }

        /*Impl End*/
        public function save()
        {
            global $_Struct;
            $savedata;
            foreach ($_Struct[$this->instance] as $data)
            {
                if(strpos($data,"time"))  $savedata[]=isset($this->$data)?$this->$data:0;
                else $savedata[]=isset($this->$data)?rawurlencode($this->$data):0;
            }

            $this->model->New($savedata);
            $this->model->getresult();
            //var_dump($_Struct[$this->instance]);
        }

    public function update()
    {
        global $_Struct;
        $savedata;
        foreach ($_Struct[$this->instance] as $data)
        {
            $savedata[$data] = isset($this->$data)?$this->$data:0;
        }
        $id = ucfirst($this->instance)."Id";
        $setid = array($id."=".$this->$id);
        $this->model->Set($savedata,$setid);
        //var_dump($savedata);

    }

    /*模板引擎
     * 参考自vemplator
     * 理论上这一部分应该放在view里
     * 但是现在写在controller里
     * view部分完全是模板和compiled过的文件
     */
    protected function RenderTemplate($action)
    {
        $this->values["USER"]=$_SESSION["USERNAME"];
        $this->values["USERID"]=$_SESSION['USERID'];
        
        global $website_info;
        foreach($website_info as $key=>$value){
            $this->values[$key] = $value;
        }
        $this->TemplateFile = $this->TemplateFolder."".$action.".rhtml";
        $compiledFile =  $this->TemplateFolder."".$action.".php";
        if(!file_exists($this->TemplateFile)){
            require_once(APPLICATION_PATH."/view/templatemissing.rhtml");
            return;
        }
        if(file_exists($this->TemplateFile)&& filemtime($compiledFile) >= filemtime($this->TemplateFile))
        {
            //echo filemtime($compiledFile),"|".filemtime($this->TemplateFile);
            require_once($compiledFile);
        }
        else
        {
            //echo "重新编译";
            $lines = file($this->TemplateFile);
            $newLines = array();
            $matches = null;
            foreach($lines as $line)  {
                $num = preg_match_all('/\{[$]([^{}]+)\}/', $line, &$matches);
                if($num > 0) {
                    for($i = 0; $i < $num; $i++) {
                        $match = $matches[0][$i];
                        $new = $this->transformSyntax($matches[1][$i]);
                        $line = str_replace($match, $new, $line);
                    }
                }
                $newLines[] = $line;
            }
            $f = fopen($compiledFile, 'w');
            fwrite($f, implode('',$newLines));
            fclose($f);
            require_once($compiledFile);

        }
    }
  
    private function include_part_template($part_template_name){
        $path = APPLICATION_PATH."/view/part_template/".$part_template_name.".rhtml";
        $lines = file($path);
         $newLines = array();
            $matches = null;
            foreach($lines as $line)  {
                $num = preg_match_all('/\{[$]([^{}]+)\}/', $line, &$matches);
                if($num > 0) {
                    for($i = 0; $i < $num; $i++) {
                        $match = $matches[0][$i];
                        $new = $this->transformSyntax($matches[1][$i]);
                        $line = str_replace($match, $new, $line);
                    }
                }
                $newLines[] = $line;
            }
        return ' "<!-- Part Template:  -->\n";?>'.implode('', $newLines). '<?php echo "<!-- Template End  -->\n"; ';

    }
    private function transformSyntax($input) {
        $from = array(
            '/(^|\|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\|\+)/',
            '/(^|\|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\|\+)/', 
            '/\./',
        );
        $to = array(
            '$1$this->values["$2$3"]',
            '$1$this->values["$2$3"]',
            '->'
        );

        $parts = explode(':', $input);

        $string = '<?php ';
        switch($parts[0]) { 
        case 'if':
        case 'switch':
            $string .= $parts[0] . '(' . preg_replace($from, $to, $parts[1]) . ') { ' . ($parts[0] == 'switch' ? 'default: ' : '');
            break;
        case 'foreach':
            $pieces = explode(',', $parts[1]);
            $string .= 'foreach(' . preg_replace($from, $to, $pieces[0]) . ' as ';
            $string .= preg_replace($from, $to, $pieces[1]);
            if(sizeof($pieces) == 3) 
                $string .= '=>' . preg_replace($from, $to, $pieces[2]);
            $string .= ') { ';
            break;
        case 'end':
        case 'endswitch':
            $string .= '}';
            break;
        case 'else':
            $string .= '} else {';
            break;
        case 'case':
            $string .= 'break; case ' . preg_replace($from, $to, $parts[1]) . ':';
            break;
        case 'ui':
            $string .= "\$ui::".$parts[1].';' ;
            break;
        case 'include':
            $string .= 'echo $this->output("' . $parts[1] . '");';
            break;
        case 'nav':
            $string .= 'echo nav_creator();';
            break;
        case 'nav1':
            $string .= 'echo nav_creator(1);';
            break;
        case 'children':
            $string .='echo child_creator();';
            break;
        case 'category':
            $string .='echo category();';
            break;
        case 'breadcrumb':
            $string .='echo bread_crumb();';
            break;
        case 'footer':
            $string .='echo footer_creator();';
            break;
        case 'part':
            $string .='echo '. $this->include_part_template($parts[1]).';';
            break;
        default:
            $string .= 'echo ' . preg_replace($from, $to, $parts[0]) . ';';
            break;
        }
        $string .= ' ?>';
        return $string;
    }
    public function set_refer($key,$value){
        $this->values[$key] = $value;

    }
    public function __call($FuncName,$arg)
    {
        $this->model->__call($FuncName,$arg);
        $this->items = $this->model->getresult();
        $this->json = $this->model->json;
        $this->firstmatch = $this->model->firstmatch;
        global $_Struct;
        foreach($_Struct[$this->instance] as $data)
        {
            $this->$data = $this->firstmatch->$data;
        }
        $id = ucfirst($this->instance)."Id";
        $this->$id =  $this->firstmatch->$id;
    }
  
    public function Get($QueryColums,$Constraints,$limit,$order)
    {
        $this->model->Get($QueryColums,$Constraints,$limit,$order);
        $this->items = $this->model->getresult();
        $this->json = $this->model->json;
        $this->firstmatch = $this->model->firstmatch;
        global $_Struct;
        foreach($_Struct[$this->instance] as $data)
        {
            $this->$data = $this->firstmatch->$data;
        }
        $id = ucfirst($this->instance)."Id";
        $this->$id =  $this->firstmatch->$id;

    }
    public function Set($QueryColums,$Constraints)
    {
        $this->model->Set($QueryColums,$Constraints);
    }
    public function Del($Constraints)
    {
        $this->model->Del($Constraints);
    }
    public function is_empty(){
        return empty($this->items);
    }
    public function GetJson()
    {
        foreach($this->model->one_to_one as $one_to_one){

            if(isset($this->$one_to_one[1])){
            }
        }                        
        return json_encode($this->json);
    }
    public function json()
    {
        return $this->json;
    }
    /*
     * help functions
     * you can overload it when implement.
     */
    public function _get($id)
    {
        if(!empty($id)){
            $cid = ucfirst($this->instance)."Id";
            $this->Get("all",array("{$cid}={$id}"));
        }else{
            $this->Get("all");
        }
        echo $this->GetJson();
    }
    public function _set($id)
    {
        $cid = ucfirst($this->instance)."Id";
        $key = $_REQUEST['key'];
        $value = $_REQUEST['value'];
        $this->Set(array($key=>$value),array("{$cid}=$id"));
        echo json_encode(true);

    }



    

}
