<?php

// http://blog.kent-chiu.com/blog/2011/10/17/ascii_class_diagram/
// 我需要先学习UML的知识，几种约定俗称的标记记号


class Pastor{
  public $name;
  public $gender;

  public function preach(){
    echo 'We should love God';
  }
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
