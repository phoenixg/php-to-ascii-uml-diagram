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

interface IPerson {
  const  TYPE = 'HUMAN';
  public function preach();
  public function pray();
  public function write();
}

class Pastor implements IPerson{
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
    return 'We should love God';
  }

  public function pray(){
    return 'God please forgive me';
  }

  public function write(){
    return 'I am writing';
  }

  public function makelove(){
    return 'I am making love';
  }
}



abstract class Weapon
{
    abstract public function description();
    abstract public function cost();
}

class Glave extends Weapon
{
    public function cost ()
    {
        return 100;
    }

    public function description ()
    {
        return 'Glave';
    }
}

class Knife extends Weapon
{
    public function cost ()
    {
        return 80;
    }

    public function description ()
    {
        return 'Knife';
    }
}

class Axe extends Weapon
{
    public function cost ()
    {
        return 120;
    }

    public function description ()
    {
        return 'Axe';
    }
}

class Property extends Weapon
{
    protected $_weapon = null;

    protected $_price = 0;

    protected $_description = '';

    public function __construct(Weapon $weapon)
    {
        $this->_weapon = $weapon;
    }

    public function cost ()
    {
        return $this->_weapon->cost() + $this->_price;
    }

    public function description ()
    {
        return $this->_weapon->description().','.$this->_description;
    }
}

class Strength extends Property
{
    protected $_price = 250;

    protected $_description = '+25 strength';
}

class Agility extends Property
{
    protected $_price = 300;

    protected $_description = '+30 agility';
}

class Intellect extends Property
{
    protected $_price = 200;

    protected $_description = '+20 intellect';
}



echo parseClassToAscii('Agility');

function parseClassToAscii($classname) {
  // 建立反射类
  $rc = new ReflectionClass($classname);

  /*
  $lineage = array();
  while ($rc = $rc->getParentClass()) {
    $lineage[] = $rc->getName();
  }
  d($lineage);
  */

  // 初始化输出内容的变量
  // $strLenMax[最大可变长度] + 5[友好值] = 定值，无需变量。所有行的长度都应该扩充到该可变长度
  // $strLen + $strPad = $strLenMax
  $strLenMax = 50;
  $ascii  = '';
  $ascii .= '+'.str_repeat('-', $strLenMax).'+'.PHP_EOL;

  // 打印反射类
  // d($rc);

  // 获取类名称
  // d($rc->getName());// Paster
  $ascii .= '| '.$rc->getName().str_repeat(' ', $strLenMax - strlen($rc->getName()) -1 ).'|'.PHP_EOL;
  $ascii .= '+'.str_repeat('-', $strLenMax).'+'.PHP_EOL;

  // 获取类属性
  $props = $rc->getProperties( ReflectionProperty::IS_PUBLIC );
  foreach ($props as $prop) {
    $ascii .= '| + '.$prop->getName().str_repeat(' ', $strLenMax - strlen($prop->getName()) -3 ).'|'.PHP_EOL;
  }

  $props = $rc->getProperties( ReflectionProperty::IS_PROTECTED );
  foreach ($props as $prop) {
    $ascii .= '| # '.$prop->getName().str_repeat(' ', $strLenMax - strlen($prop->getName()) -3 ).'|'.PHP_EOL;
  }

  $props = $rc->getProperties( ReflectionProperty::IS_PRIVATE );
  foreach ($props as $prop) {
    $ascii .= '| - '.$prop->getName().str_repeat(' ', $strLenMax - strlen($prop->getName()) -3 ).'|'.PHP_EOL;
  }

  $ascii .= '+'.str_repeat('-', $strLenMax).'+'.PHP_EOL;


  // 获取类方法
  $methods = $rc->getMethods( ReflectionMethod::IS_PUBLIC );
  foreach ($methods as $method) {
    $ascii .= '| + '.$method->getName().'()'.str_repeat(' ', $strLenMax - strlen($method->getName()) -5 ).'|'.PHP_EOL;
  }

  $methods = $rc->getMethods( ReflectionMethod::IS_PROTECTED );
  foreach ($methods as $method) {
    $ascii .= '| # '.$method->getName().'()'.str_repeat(' ', $strLenMax - strlen($method->getName()) -5 ).'|'.PHP_EOL;
  }

  $methods = $rc->getMethods( ReflectionMethod::IS_PRIVATE );
  foreach ($methods as $method) {
    $ascii .= '| - '.$method->getName().'()'.str_repeat(' ', $strLenMax - strlen($method->getName()) -5 ).'|'.PHP_EOL;
  }

  $ascii .= '+'.str_repeat('-', $strLenMax).'+'.PHP_EOL;

  return '<pre>'.$ascii.'</pre>';
}






















































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
