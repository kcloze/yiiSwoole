<?php ob_start();?>
<!doctype html>
<html dir="ltr" lang="zh-CN" xml:lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data[$current]['seo_title']?$data[$current]['seo_title']:$this->_seoTitle?></title>
	  <meta name="description" content="<?php echo $data[$current]['seo_description']?$data[$current]['seo_description']:$this->_seoDescription?>">
	  <meta name="keywords" content="<?php echo $data[$current]['seo_keywords']?$data[$current]['seo_keywords']:$this->_seoKeywords?>">
    <link rel="icon" href="<?php echo $this->_baseUrl;?>/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo $this->_baseUrl;?>/static/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/static/gonglv/style/base.css?v=<?php echo $this->_static_version;?>" />
    <link rel="stylesheet" type="text/css" href="/static/gonglv/style/ui.css?v=<?php echo $this->_static_version;?>" />
	<script type="text/javascript">var webUrl = '<?php echo Yii::app()->request->getHostInfo()?>';var staticPath = '<?php echo $this->_baseUrl?>/static/';var currentScript = '<?php echo Yii::app()->request->getScriptUrl()?>';</script>
	<script type="text/javascript" src="/static/gonglv/js/jquery.min.js"></script>
</head>
<body>
<?php $this->renderPartial('/_include/header')?>

    <div class="wrapper clearfix">
		<!--<h1>Test...</h1>
		<p><button onclick="send()">Post</button></p>-->
    </div>
    <div class="wrapper clearfix quick">
    <input type="text" name="keyword" style="width:60%"/>
    </div>
    <div class="wrapper clearfix result">
    <p>1</p>
    <p>2</p>
    </div>

<?php $this->renderPartial('/_include/footer')?>
</body>
</html>
<script type="text/javascript">
function send()
{
	alert('start');
	var url = 'https://api.weixin.qq.com/cgi-bin/customservice/getrecord?access_token=7rgg0K9jnsAV4JX77Ohl9Lk-8c3uAepPgbORUYLId1VcL0Dfv_sPHNsHs0Hz4fVbOVsicoDnUUncjZZIyRSFfA';

	$.post(
		url,
		{
		 "starttime" : 1410278400,
		 "endtime" : 1410430321,
		 "openid" : "OPENID",
		 "pagesize" : 10,
		 "pageindex" : 1,
		},
		function(status)
		{
			alert(status);
		}
	);
}
	
</script>
<?php 
$str=ob_get_contents();
ob_end_clean();
echo XUtils::compress_html($str);
?>
