<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBtrC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>test</title>
</head>
<body>
	<table>
			<tr>
				<td>商品标题:</td>
				<td><?php echo ($title); ?></td>
			</tr>
			<tr>
				<td>价格:</td>
				<td><?php echo ($price); ?></td>
			</tr>
			<tr>
				<td>商铺名:</td>
				<td><?php echo ($item['shop_name']); ?></td>
			</tr>
			<tr>
				<td>淘宝昵称:</td>
				<td><?php echo ($item['tb_nick']); ?></td>
			</tr>
			<tr>
				<td>qq:</td>
				<td><?php echo ($item['qq']); ?></td>
			</tr>
			<tr>
				<td>手机:</td>
				<td><?php echo ($item['phone']); ?></td>
			</tr>
			
			
	</table>	
	<pre><?php echo ($content); ?></pre>
	<?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="<?php echo ($vo); ?>" alt="" /><?php endforeach; endif; else: echo "" ;endif; ?>
	
</body>
</html>