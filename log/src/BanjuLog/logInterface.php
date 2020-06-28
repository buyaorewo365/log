<?php
/**
 * 伴聚日志sdk
 * @author   lyj <[313535835@qq.com]>
 */
namespace BanjuLog;

interface logInterface{
    public function write();
    public function setBasePath($path);
    public function getBasePath();
    public function setProject($porject);
    public function getProject();
    public function setData($data);
    public function getData();
    public function setLevel($level);
    public function getLevel();
    public function setDateFormat($format);
    public function getDateFormat();

}