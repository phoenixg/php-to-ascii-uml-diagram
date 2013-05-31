<?php
header("Content-type: text/html; charset=utf-8");

/* include Kint the debugger */
include './kint-master/Kint.class.php';
Kint::enabled(true);
/*
d( $_SERVER );
Kint::trace();
*/

// http://blog.kent-chiu.com/blog/2011/10/17/ascii_class_diagram/
// UML（统一建模语言）
/*
+--------+
| Client |
+--------+
 +--------+       +---------------------+ *
 | Client |------>| Component           |<-----------------------------+
 +--------+       +---------------------+                              |
                  | Operation()         |                              |
                  | Add(Component)      |                              |
                  | Remove(Component)   |                              |
                  | GetChild(int)       |                              |
                  +---------------------+                              |
                            #                                          |
                            |                                          |
                 +----------+--------------+                           |
                 |                         |                           |
          +------+------+       +----------+----------+  children      |
          | Leaf        |       | Composite           |O---------------+
          +-------------+       +---------------------+
          | Operation() |       | Operation()         |
          +-------------+       | Add(Component)      |
                                | Remove(Component)   |
                                | GetChild(int)       |
                                +---------------------+



class Pastor{
  private   $address;
  protected $hobby;
  public    $name = 'Tom';
  public    $gender;

  public function __construct($para1, $para2){
    $this->address = '';
    $this->hobby   = array('music', 'dance');
    $this->name    = 'Hehuan';
    $this->gender  = 'female';
  }

  public function preach($para3){
    echo 'We should love God' . $para3;
  }

  public static function pray(){
    return 'God please forgive me';
  }

  protected function write(){
    return 'I am writing';
  }

  private function makelove(){
    return 'I am making love';
  }
}

+------------------------------------+
| Paster                             |
+------------------------------------+
| + $name : String [Tom]             |
| + $gender                          |
| - $address                         |
| # $hobby                           |
+------------------------------------+
| + <<create>> ($para1, $para2)      |
| + preach($para3) : void            |
| + <<static>> pray() : String       |
| # write() : String                 |
| - makelove() : String              |
+------------------------------------+



类名
属性
方法

属性
<可见性> <属性名称> : <数据类型> [=默认值]

方法（如果无返回值，则用void表示）
<可见性> <方法名称>([<参数列表>]) : <返回数据类型>

方法的参数
[in] <参数名称> : <数据类型> [=<默认值>]

其他
<可见性> public(+表示) ， protected(#表示) ， private(-表示)
静态成员前面加下划线 或 <<static>>表示
构造函数用<<create>>表示
析构函数用<<destroy>>表示

-------------------------------------------------------------------------------------------------------------------
*/
define('TAG_OUTLINE_CORNER',       '+');
define('TAG_OUTLINE_HORIZONTAL',   '-');
define('TAG_OUTLINE_VERTICAL',     '|');
define('TAG_VISIBILITY_PUBLIC',    '+');
define('TAG_VISIBILITY_PROTECTED', '#');
define('TAG_VISIBILITY_PRIVATE',   '-');
define('TAG_DECORATE_STATIC',      '&lt;&lt;static&gt;&gt;');

class Pastor{
  private   $address;
  protected $hobby;
  public    $name = 'Tom';
  public    $gender;

  public function __construct($para1, $para2){
    $this->address = '';
    $this->hobby   = array('music', 'dance');
    $this->name    = 'Hehuan';
    $this->gender  = 'female';
  }

  public function preach(){
    echo 'We should love God';
  }

  public static function pray(){
    echo 'God please forgive me';
  }

  protected function write(){
    echo 'I am writing';
  }

  private function makelove(){
    echo 'I am making love';
  }
}



// 建立反射类
$rc = new ReflectionClass('Pastor');

// 初始化输出内容的变量
$ascii  = '';
$ascii .= '+-----------------------------------------+'.PHP_EOL;

// 打印反射类
d($rc);

// 获取类名称
d($rc->getName());// Paster
$ascii .= '| '.$rc->getName().'                                  |';

// 获取类属性
$props = $rc->getProperties( ReflectionProperty::IS_PUBLIC |
                             ReflectionProperty::IS_PROTECTED |
                             ReflectionProperty::IS_STATIC |
                             ReflectionProperty::IS_PRIVATE );
foreach ($props as $prop) {
  d($prop->getName());
}

// 获取类方法
$methods = $rc->getMethods();
foreach ($methods as $method) {
  d($method->getName());
}


echo '<pre>';
echo $ascii;
echo '</pre>';
























































echo '<hr />';
echo '<pre>';
$diagram = '
 +--------+       +---------------------+ *
 | Client |------>| Component           |<-----------------------------+
 +--------+       +---------------------+                              |
                  | Operation()         |                              |
                  | Add(Component)      |                              |
                  | Remove(Component)   |                              |
                  | GetChild(int)       |                              |
                  +---------------------+                              |
                            #                                          |
                            |                                          |
                 +----------+--------------+                           |
                 |                         |                           |
          +------+------+       +----------+----------+  children      |
          | Leaf        |       | Composite           |O---------------+
          +-------------+       +---------------------+
          | Operation() |       | Operation()         |
          +-------------+       | Add(Component)      |
                                | Remove(Component)   |
                                | GetChild(int)       |
                                +---------------------+';
echo $diagram;
echo '</pre>';
