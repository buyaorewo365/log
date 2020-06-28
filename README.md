# log
日志系统-->基于seaslog的日志sdk
# 调用方式
require('banjulog/autoload.php');
use BanjuLog\log;
# 创建日志对象
$obj=new log();
# 数据结构
$data=[
    'action'=>'111',
    'bhv_type'=>'22',
    'user_type'=>'33',
    'bhv_type'=>'44',
    'user_id'=>'55',
    'act_obj'=>'66',
    'obj_type'=>'77',
    'event'=>'88',
    'trace_id'=>'99',
    'bhv_datetime'=>'100',
    'pos_type'=>'101',
    'position'=>'102',
    'env'=>'103',
    'plates'=>'104'
];
# 设置基础路劲
$res=$obj->setBasePath('/data/banjulog')
# 设置数据
->setData($data)
# 设置项目目录
->setProject('test')
# 设置日志错误级别
->setLevel('debug')
# 设置时间戳格式
->setDateFormat('YmdHis')
# 写入日志
->write();
# 如果返回true,写入成功
var_dump($res);
# 说明:set开头方法为设置,get开头方法为获取,如果不设置为默认php配置