<?php

namespace Clear\Config;

class Config
{

    /**
     * 配置文件路径
     *
     * @var string
     */
    protected $path;

    /**
     * 运行环境名称
     *
     * @var array
     */
    protected $env = '';

    /**
     * 临时设置
     *
     * @var array
     */
    protected $tempConfig = [];

    /**
     * 初始化配置
     */
    public function __construct($path, $env)
    {
        $this->path = $path;
        if (is_dir(path_join($path, $env))) {
            $this->env = $env;
        }
    }

    /**
     * 读取配置
     *
     * @param string $key
     * @param mixed  $default
     * 
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (isset($this->tempConfig[$key])) {
            return $this->tempConfig[$key];
        }

        list($namespace, $group, $item) = $this->parseKey($key);

        $baseConfigFile = path_join($this->path, $namespace . '.php');
        $currentEnvConfigFile = path_join($this->path, $this->env, $namespace . '.php');

        if (!file_exists($baseConfigFile)) {
            return $default;
        }

        $config = $this->load($baseConfigFile);

        if (!$config) {
            return $default;
        }
        $currentEnvConfig = $this->load($currentEnvConfigFile);

        if ($currentEnvConfig) {
            $config->merge($currentEnvConfig);
        }
        $configArray = [$namespace => $config->toArray()];

        return array_get($configArray, $key);
    }

    /**
     * 检测是否有配置 
     *
     * @param string $key   
     *
     * @return boolean 
     */
    public function has($key)
    {
        return null !== $this->get($key);
    }

    /**
     * 修改配置
     *
     * @param string $key  
     * @param mixed  $value
     *
     * @return void
     */
    public function set($key, $value)
    {
        $this->tempConfig[$key] = $value;
    }

    /**
     * 读取配置文件
     *
     * @param string $path 文件路径 
     *
     * @return array
     */
    protected function load($path)
    {
        if (!stream_resolve_include_path($path)) {
            return false;
        }

        $configArray = include $path;

        if (!is_array($configArray)) {
            return false;
        }

        //TODO: 合并配置

        return $config;
    }

    /**
     * 解析配置key
     *
     * @param string $key 
     *
     * @return array
     */
    protected function parseKey($key)
    {
        $arr = explode('.', $key);

        return [
            $arr[0],
            !isset($arr[0]) ? $arr[1] : '',
            !isset($arr[0]) ? $arr[2] : '',
        ];
    }

}
