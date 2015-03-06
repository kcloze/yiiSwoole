<?php ob_start();?>
<!doctype html>
<html dir="ltr" lang="zh-CN" xml:lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $content['seo_title']?$content['seo_title']:$this->_seoTitle?></title>
	  <meta name="description" content="<?php echo $content['seo_description']?$content['seo_description']:$this->_seoDescription?>">
	  <meta name="keywords" content="<?php echo $content['seo_keywords']?$content['seo_keywords']:$this->_seoKeywords?>">
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
	     	<li><a href="/<?php echo $value['url'];?>" <?php if($current == $value['url']):?>class="current"<?php endif;?>><?php echo $value['title'];?></a></li>
	     <?php endforeach?>
	       <li><a href="/<?php echo $helpInfo[$helpAlias[0]]['url']?>">帮助中心</a></li>
	     </ul>
	   </div>
	   <div class="r-main">
       <div class="order_user">
         <h1 class="news-tit"><?php echo $content['title']?></h1>
         <div class="news-infor"><span class="source">发布时间：<?php echo $content['copy_url']?></span><span class="source">作者：<?php echo $content['author']?></span><span class="source">来源：<?php echo $content['copy_from']?></span></div>
         <div class="abo_detail">
			<?php echo $content['content'];?>
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