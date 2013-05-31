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

$test1 = new ReflectionClass('Pastor');
d($test1);die;































































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
