<!doctype html>
<html dir="ltr" lang="zh-CN" xml:lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->_seoTitle?></title>
	<meta name="description" content="<?php echo $this->_seoDescription?>">
	<meta name="keywords" content="<?php echo $this->_seoKeywords?>">
    <link rel="icon" href="<?php echo $this->_baseUrl;?>/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo $this->_baseUrl;?>/static/images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="/static/gonglv/style/base.css?v=<?php echo $this->_static_version;?>" />
	<link rel="stylesheet" type="text/css" href="/static/gonglv/style/ui.css?v=<?php echo $this->_static_version;?>" />
	<script type="text/javascript">var webUrl = '<?php echo Yii::app()->request->getHostInfo()?>';var staticPath = '<?php echo $this->_baseUrl?>/static/';var currentScript = '<?php echo Yii::app()->request->getScriptUrl()?>';</script>
	<script type="text/javascript" src="/static/gonglv/js/jquery.min.js"></script>
	<script type="text/javascript" src="/static/js/jquery/jquery.lazyload.min.js"></script>
</head>
<body>
<?php $this->renderPartial('/_include/header')?>
	<div class="wrapper fn-clear">
		<div class="err-box fn-clear">
			<div class="err-txt fn-left">
				<p class="p1">精品周边游团购：<strong><a href="http://www.yaochufa.com" class="txte97">要出发旅游网</a></strong></p>
				<p class="p2">周边旅旅游攻略：<span><a href="<?php echo Yii::app()->request->getHostInfo()?>" class="txte97">要出发周边攻略</a>  <a href="<?php echo Yii::app()->request->getHostInfo()?>/t_weigonglue" class="txte97">原创微攻略</a></span></p>
				<p class="p3">随时随地下单、查攻略：</p>
				<p class="p4"><a href="http://www.yaochufa.com/about/mobile#you"><img src="/static/gonglv/images/app-code.png" width="116" height="140"></a><img src="/static/gonglv/images/m-code.png" width="116" height="140" /></p>
				<p class="p5">系统自动跳转在  <span class="time" id="time"><?php echo $data['times'];?></span>  秒后，如果不想等待，<a href="<?php echo $data['url'];?>" class="txt-f7e">点击这里跳转</a></p>
			</div>

			<div class="fn-right err"></div>
		</div>
		<div class="Corporate_site fn-clear"><div class="hot-city-strategy clearfix"><p class="content-title2">热门城市周边游攻略</p><p class="box-zhoubian">
			<a class="city_gonglue" href="/beijing" rel="external" title="北京原创精品攻略">北京旅游攻略</a>
	        <a class="city_gonglue" href="/shanghai" rel="external" title="上海原创精品攻略">上海旅游攻略</a>
	        <a class="city_gonglue" href="/tianjin" rel="external" title="天津原创精品攻略">天津旅游攻略</a>
	        <a class="city_gonglue" href="/chongqing" rel="external" title="重庆原创精品攻略">重庆旅游攻略</a>
	        <?php foreach((array)$data['hot_city'] as $key=>$newsRow):?>
	            <a class="city_gonglue" href="<?php echo $this->_baseUrl.'/'.$newsRow['catalog_name_alias'];?>" rel="external" title="<?php echo $newsRow['catalog_name_second']?>原创精品攻略"><?php echo $newsRow['catalog_name_second']?>旅游攻略</a>
	        <?php endforeach?> 
		</p></div></div>
	</div>
<?php $this->renderPartial('/_include/footer')?>
</body>
<script type="text/javascript">
function delayURL(url) {
        var delay = document.getElementById("time").innerHTML;
        //alert(delay);
        if(delay > 0){
        delay--;
        document.getElementById("time").innerHTML = delay;
    } else {
    window.location.href = url;
    }
    setTimeout("delayURL(\'" + url + "\')", 1000);
}
delayURL("<?php echo $data['url'];?>");
</script>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000490894'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1000490894' type='text/javascript'%3E%3C/script%3E"));</script>
</html>