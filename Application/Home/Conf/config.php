<?php
return array(
	//'配置项'=>'配置值'
	'URL_ROUTER_ON'=>true,
	'URL_ROUTE_RULES'=>array(
	//':uid/:zdid/:goods_id.html'=>':uid/:zdid/:goods_id.html',	
	//':uid/:zdid/:goods_id'=>'Product/index',
    ':zdid/:goods_id' => 'Index/index',
    'view'	=>	'ViewIndex/view',
    'viewPro'          =>  'ViewProduct/view2',
    'Adv'	=>	'Adv/index',
	),
	


);