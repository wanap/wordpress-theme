<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> 
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>哎呀…您访问的页面不存在</title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/404/404.css"/>
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<div class="bg">
	<div class="cont">
		<div class="c1"><img src="<?php bloginfo('template_url');?>/404/images/01.png" class="img1" /></div>
		<h2>哎呀…您访问的页面不存在</h2>
		<div class="c2">
			<a href="javascript:history.go(-1)" class="re">上一页</a>
			<a href="<?php bloginfo('home');?>" class="home">网站首页</a>
			<a href="<?php bloginfo('home');?>" class="sr">搜索一下页面相关信息</a>
		</div>
		<div class="c3"><a class="c3">&nbsp;</a>提醒您 - 您可能输入了错误的网址，或者该网页已删除或移动!</div>
	</div>
</div>
</body>
</html>