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
	<script type="text/javascript" src="/static/js/jquery/jquery.lazyload.min.js"></script>
</head>
<body>
<?php $this->renderPartial('/_include/header')?>

    <div class="wrapper clearfix">
		<div class="leftnav">
	     <ul>
	     <?php foreach ($data as $key=>$value):?>
	     	<li><a <?php if($current==$value['url']):?>class="current"<?php endif?> href="/<?php echo $value['url'];?>"><?php echo $value['title'];?></a></li>
	     <?php endforeach?>
	       <li><a href="/<?php echo $helpInfo[$helpAlias[0]]['url']?>">帮助中心</a></li>
	     </ul>
	   </div>
	   <?php if($data[$current]['content']):?>
	   <div class="r-main">
       <div class="order_user">
       <?php echo $data[$current]['content']?>
       </div>
      </div>
      <?php if($data[$current]['bagecmsPagebar']):?>
      <div class="page">
	  	<?php echo $data[$current]['bagecmsPagebar']->show(1)?>
	  </div>
	  <?php endif?>
      <?php endif?>
    </div>

<?php $this->renderPartial('/_include/footer')?>
</body>
</html>
<script type="text/javascript">
$(function(){
	$(".navigate ul li").removeClass("selectitem");
})
	
</script>
<?php 
$str=ob_get_contents();
ob_end_clean();
echo XUtils::compress_html($str);
?>
