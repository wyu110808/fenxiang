<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
 	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 	<title>分享</title>
 </head>
 <body>
 	<form action="<?php echo U('Index/insert');?>" method="post" name="fenxiang">
 		<table align="center">
 			<tr>
 				<td><input type="hidden" name="uid" value="<?php echo ($uid); ?>"/></td>
 				<td><input type="hidden" name="pid" value="<?php echo ($pid); ?>"/></td>
 				<td><input type="hidden" name="zid" value="<?php echo ($zid); ?>"/></td>
 			</tr>
 			<tr>
 				<td>标题</td>
 				<td><input type="text" name="title" id="" /></td>
 			</tr>
 			<tr>
 				<td>价格</td>
 				<td><input type="text" name="price" id="" /></td>
 			</tr>
 			<tr>
 				<td>利率</td>
 				<td><input type="text" name="profit" id="" /></td>
 			</tr>
 			<tr>
 				<td>修正价</td>
 				<td><input type="text" name="add_price" id="" /></td>
 			</tr>
 			<tr>
 				<td>qq号</td>
 				<td><input type="text" name="qq" id="" /></td>
 			</tr>
 			<tr>
 				<td>旺旺</td>
 				<td><input type="text" name="wangwang" id="" /></td>
 			</tr>
 			<tr>
 				<td>微信号</td>
 				<td><input type="text" name="weichat" id="" /></td>
 			</tr>
 			<tr>
 				<td>手机号</td>
 				<td><input type="text" name="phone" id="" /></td>
 			</tr>
 			<tr>
 				<td>自定义信息</td>
 				<td><textarea name="content" id="" cols="30" rows="10"></textarea></td>
 			</tr>
 			<tr>
 				<td>提交</td>
 				<td><input type="submit" value="提交" /></td>
 			</tr>
 		</table>
 	</form>
 </body>
 </html>