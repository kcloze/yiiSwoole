<?php ob_start();?>
<!doctype html>
<html dir="ltr" lang="zh-CN" xml:lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $helpInfo[$current]['seo_title']?$helpInfo[$current]['seo_title']:$this->_seoTitle?></title>
	  <meta name="description" content="<?php echo $helpInfo[$current]['seo_description']?$helpInfo[$current]['seo_description']:$this->_seoDescription?>">
	  <meta name="keywords" content="<?php echo $helpInfo[$current]['seo_keywords']?$helpInfo[$current]['seo_keywords']:$this->_seoKeywords?>">
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

    <div class="wrapper clearfix">
		<div class="leftnav">
	     <ul>
	     <?php foreach ($data as $key=>$value):?>
	     	<li><a href="/<?php echo $value['url'];?>"><?php echo $value['title'];?></a></li>
	     <?php endforeach?>
	       <li><a class="current" href="/<?php echo $helpInfo[$helpAlias[0]]['url']?>">帮助中心</a></li>
	     </ul>
	   </div>

	   <div class="r-main">
       <div class="help-box">
       	<ul class="help-ul fn-clear">
       		<?php foreach ($helpInfo as $key=>$value):?>
	     		<li><a <?php if($current==$value['url']):?>class="cur"<?php endif?> href="/<?php echo $value['url'];?>"><?php echo $value['title'];?></a></li>
	     	<?php endforeach?>
       	</ul>
       	<div class="help-cont">
       		<?php foreach ($helpInfo as $key=>$value):?>
	       		<div <?php if($value['url'] == $current):?> class="unit" <?php else:?> class="unit fn-hide" <?php endif?>>
					<?php echo $value['content'];?>
	       		</div>
	     	<?php endforeach?>
       	</div>
       </div>
      </div>

    </div>

<?php $this->renderPartial('/_include/footer')?>
</body>
<script type="text/javascript">
$(function(){
	$(".navigate ul li").removeClass("selectitem");

})
</script>
</html>
<?php 
$str=ob_get_contents();
ob_end_clean();
echo XUtils::compress_html($str);
?>