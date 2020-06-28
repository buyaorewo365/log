<?php
/**
 * this is  a banjulog sdk
 * author lyj
 * email 313535835@qq.com
 */
namespace BanjuLog;
use BanjuLog\logInterface;
use Seaslog;
class log implements logInterface
{
	const ALLTYPE = ['debug','info','notice','warning','error','critical','alert','emergency'];
 	private $_data=[];
    private $_level='info';
    private $_project='default';
    private $_path='/data/logs/seaslog';
    private $_date_format= 'Y-m-d H:i:s';
    public function __construct(){
    	// 参数  字段类型    描述  Nullable
        // action  string  取值‘behavior’    否
        // bhv_type    string  行为类型    否
        // user_type   string  操作人类型   否
        // user_id string  用户唯一ID  否
        // act_obj string  行为对象ID  否
        // obj_type    string  行为对象类型，默认为item（由元信息类定义） 否
        // event   string  具体操作事件内容    否
        // trace_id    string  如果发生行为的物品是推荐引擎引导，取值为同推荐列表一起返回的trace_id  是
        // bhv_datetime    string  行为时间,字符串e格式 ‘yyyy-MM-dd HH:mm:ss’   否
        // pos_type    string  行为发生的位置类型， ll：经纬度格式的位置信息    是
        // position    string  行为发生的位置，根据pos_type有不同的取值格式： 是
        // 如果pos_type=ll，position格式’longitude:latitude’
        // env object  其他环境参数，如IP，Network  是
        // plates  string  板块分组信息，逗号分隔字符串  是
         $data=[
            'action'=>'',
            'bhv_type'=>'',
            'user_type'=>'',
            'bhv_type'=>'',
            'user_id'=>'',
            'act_obj'=>'',
            'obj_type'=>'',
            'event'=>'',
            'trace_id'=>'',
            'bhv_datetime'=>'',
            'pos_type'=>'',
            'position'=>'',
            'env'=>'',
            'plates'=>'',
        ];
        $this->_data=$data;
        SeasLog::setBasePath ($this->_path);
        SeasLog::setDatetimeFormat ( $this->_date_format);
    }
    //设置format
    public function setDateFormat($format)
    {
        $this->_date_format=$format;
        SeasLog::setDatetimeFormat ( $this->_date_format);
        return $this;
    }
    //获取时间format
    public function getDateFormat()
    {
        return $this->_date_format;
    }
    //设置日志目录
    public function setBasePath($path)
    {
    	if(!is_dir($path)){
    		$this->makedir($path);
    	}
    	$this->_path=$path;
        SeasLog::setBasePath ($this->_path);
    	return $this;
    }
    //获取日志目录
    public function getBasePath()
    {
    	return $this->_path;
    }
    //设置项目
    public function setProject($project)
    {
    	$this->_project=$project;
    	return $this;
    }
    //获取项目
    public function getProject()
    {
    	return $this->_project;
    }
    //设置日志级别
    public function setLevel($level)
    {
    	$this->_level=$level;
    	return $this;
    }
    //获取日志级别
    public function getLevel()
    {
    	return $this->_level;
    }
    //设置日志数据
    public function setData($data)
    {
    	if(isset($data['action'])){
            $this->_data['action']=$data['action'];
        }
        if(isset($data['bhv_type'])){
            $this->_data['bhv_type']=$data['bhv_type'];
        }
        if(isset($data['user_type'])){
            $this->_data['user_type']=$data['user_type'];
        }
        if(isset($data['user_id'])){
            $this->_data['user_id']=$data['user_id'];
        }
        if(isset($data['act_obj'])){
            $this->_data['act_obj']=$data['act_obj'];
        }
        if(isset($data['obj_type'])){
            $this->_data['obj_type']=$data['obj_type'];
        }
        if(isset($data['event'])){
            $this->_data['event']=$data['event'];
        }
        if(isset($data['bhv_datetime'])){
            $this->_data['bhv_datetime']=$data['bhv_datetime'];
        }
        if(isset($data['pos_type'])){
            $this->_data['pos_type']=$data['pos_type'];
        }
        if(isset($data['position'])){
            $this->_data['position']=$data['position'];
        }
        if(isset($data['env'])){
            $this->_data['env']=$data['env'];
        }
        if(isset($data['plates'])){
            $this->_data['plates']=$data['plates'];
        }
        return $this;
    }
    //获取日志数据
    public function getData()
    {
    	return $this->_data;
    }
    //写日志
    public function write()
    {
    	$level=$this->_level;
    	if(!$this->checkLevelType($level)){
    		return false;
    	}
    	Seaslog::$level(json_encode($this->_data),[],$this->_project);
    	return true;
    }
    //检测错误级别
    private function checkLevelType($type) {
        if(!in_array($type,self::ALLTYPE)) {
            return false;
        }
        return true;
    }
    //创建目录
    private function makedir($path)
    {
    	return  is_dir ( $path ) or $this->makedir(dirname( $path )) and  mkdir ( $path , 0777);
    }
}
