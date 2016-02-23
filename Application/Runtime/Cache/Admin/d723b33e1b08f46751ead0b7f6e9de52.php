<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>test</title>
</head>
<body>
	<?php echo file_get_contents('http://fenxiang.vip.17zwd.com/top.do')?>
	<form action="http://fenxiang.vip.17zwd.com/test.do" method="post">
		<textarea name="" id="" cols="30" rows="10"><?php echo ($result); ?></textarea>
		<input type="text" name="url"/>
		<input type="text" name="canshu"/>
		<input type="submit" value="submit"/>
	</form>
	<?php echo file_get_contents('http://fenxiang.vip.17zwd.com/footer.do')?>
</body>
</html>