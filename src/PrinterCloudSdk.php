<?php

namespace Puzzle9\PrinterCloudSdk;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * @method static Service\Feieyun feieyun()
 */
class PrinterCloudSdk extends LaravelFacade
{
    public static function getFacadeAccessor()
    {
        return self::class;
    }
    
    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::getFacadeRoot()->with($name);
    }
    
    /**
     * 获取相关服务
     * @param string $name 服务名称
     */
    public function with($name)
    {
        $config = config('printersdk');
        
        $class = __NAMESPACE__ . '\\Service\\' . ucfirst($name);
        
        return new $class($config[$name]);
    }
}