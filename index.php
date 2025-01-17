<?php
  	// 引入类
	require_once('inc/require.php');
	
	// 重定向
  	if(isset($_GET['u'])) {
    	$url_c = new url();
    	// 获取目标网址
    	$url = $url_c->get_url($_GET['u']);
    	// 重定向至目标网址
    	if($url) {
      		header('Location: ' . $url);
      		exit;
    	}
  	}
?>
<!DOCTYPE HTML>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!--标题-->
	    <title><?php echo get_title() . ' - ' . get_description(); ?></title>
	    <link rel="shortcut icon" href=".\img\favicon.ico">
	    <!--介绍、关键词的放置处（SEO优化）-->
	    <meta name="description" content="ShortLink 短链接服务">
	    <meta name="keyword" content="短链接,ShortLink,Link,链接缩短,短网址">
		<!--引入 CSS 文件-->
	    <link type="text/css" rel="stylesheet" href="asset/css/main.css">
	</head>
	<body>
	    <div class="wrap">
  			<!--网页显示标题-->
			<div class="meta">
				<h2 class="title"><?php echo get_title(); ?></h2>
				<h3 class="description"><?php echo get_description(); ?></h3>
			</div>
			<br><br>
  			<!--链接显示区-->
			<div class="link-area">
				<input id="url" type="text" placeholder="源网址" />
				<input id="submit" type="button" value="生成" onclick="APP.fn.setUrl(this)" />
				<br><br>
				<input id="shorturl" type="text" placeholder="短网址" readonly/>
				<input id="shorturlcopy" type="button" value="复制" onclick="copyText()" />
			</div>
			<div class="footer">
			<div class="Copyright" style="font-size:18px">
				<a href="https://baiyun.gq/">白云</a> Copyright &copy; 2020 All Rights Reserved
			</div>
			<div class="Powers">
				Powered by <a href="https://www.baoshuo.ren/">宝硕</a> and <a href="https://github.com/Caringor/">Caringor</a>
			</div>
			</div>
	    </div>
		<!--嵌入 JS 代码-->
		<script>
			document.body.oncopy = function() {
				Swal.fire({
					allowOutsideClick:false,
					type:'success',
					title: '复制成功！',
					showConfirmButton: false,
					timer: 3000
				});
			};
		</script>
		<!--引入 JS 文件-->
		<script type="text/javascript" src="asset/js/app.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	</body>
	
</html>