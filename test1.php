<?php 

// 反射学习

/* 导出完整的反射API */
Reflection::export(new ReflectionExtension('reflection'));

/* 只反射用户自定义的类 */
class userClass{
	public function userMethod($userParameter = 'default'){}
}
foreach (get_declared_classes() as $class) {
	$reflectionClass = new ReflectionClass($class);
	if ($reflectionClass->isUserDefined()) {
		Reflection::export($reflectionClass);
	}
}

// TO P65 第7章 PHP 高级程序设计模式、框架与测试