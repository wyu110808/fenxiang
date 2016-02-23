<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',// 数据库类型
	'DB_HOST'=>'127.0.0.1',// 服务器地址
	'DB_NAME'=>'17db',// 数据库名
	'DB_USER'=>'root',// 用户名
	'DB_PWD'=>'',// 密码
	'DB_PORT'=>3306,// 端口
	//'DB_PREFIX'=>'think_',// 数据库表前缀
	'DB_CHARSET'=>'utf8',// 数据库字符集

	'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
	'DEFAULT_MODULE'       =>    'Home',  // 默认模块


	//域名绑定
	'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
	'APP_SUB_DOMAIN_RULES'    =>    array(   
    	'fenxiang.vip.17zwd.com'  => 'Admin',  // admin.domain1.com域名指向Admin模块
    	//'fenxiang.17vdian.com' => 'Home',
    	// 'test.domain2.com'   => 'Test',  // test.domain2.com域名指向Test模块
	),
	'SHOW_PAGE_TRACE'	=>	1,	//开启trace调试工具

	'LOG_RECORD' => true,
	

);