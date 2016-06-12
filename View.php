<?php
namespace Stylite;
/**
 * 
 * 视图
 * @author mantou
 *
 */
namespace Miniyard;
class View{
    
    /**
     * 变量
     * @var unknown
     */
    private static $vars = [];
    
    /**
     * 设置
     * @param unknown $name
     * @param string $value
     */
    public static function assign($name,$value='')
    {
        if(is_array($name)) {
            self::$vars   =  array_merge(self::$vars,$name);
        }else {
            self::$vars[$name] = $value;
        }
    }
    public function __set($name,$value)
    {
        self::assign($name);
    }
    
    /**
     * 生成html
     * @param unknown $tpl
     * @param unknown $file
     * @param string $content
     */
    public static function makeHtml($tpl,$file,$content='')
    {
        empty( $content ) and $content = self::fatch($tpl);
        return file_put_contents($file, $content);
    }
    
    /**
     * 渲染模板
     * @param unknown $tpl
     */
    public static function fatch($tpl)
    {
        ob_start();
        ob_implicit_flush(0);
        extract(self::$vars, EXTR_OVERWRITE);
        include $tpl;
        return ob_get_clean();
    }
    
    /**
     * 显示模板
     * @param unknown $tpl
     */
    public static function display($tpl)
    {
        echo self::fatch($tpl);
    }
}