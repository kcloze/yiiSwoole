<?php ob_start();?>
<!doctype html>
<html dir="ltr" lang="zh-CN" xml:lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['seo_info']['seo_title']?$data['seo_info']['seo_title']:$this->_seoTitle?></title>
	<meta name="description" content="<?php echo $data['seo_info']['seo_description']?$data['seo_info']['seo_description']:$this->_seoDescription?>">
	<meta name="keywords" content="<?php echo $data['seo_info']['seo_keywords']?$data['seo_info']['seo_keywords']:$this->_seoKeywords?>">
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
        	<div class="toper fn-clear">
    		<div class="aside-column">
    			<div class="l-focus">
					<ul class="cont">
					<?php foreach((array)$data['lunbo_post'] as $key=>$pt):?>
						<li><a class="img-inner" href="<?php echo $this->_baseUrl.'/v_'.$pt['title_alias'];?>" target="_blank">
						<img src="<?php echo XUtils::realImageUrl($pt['attach_thumb'],Yii::app()->params['imagStaticStyle']['280#190']);?>" width="280" height="190"/><p><?php echo mb_substr($pt['title'],0,15,'UTF-8');?></p>
						<span class="bg"></span></a>
						</li>
				    <?php endforeach?>
					</ul>
					<div class="pagination" id="J_p1">
						<span class="current">1</span>
						<span class="">2</span>
						<span class="">3</span>
						<span class="">4</span>
						<span class="">5</span>
					</div>
				</div>
    			<div class="tag-box"><div class="tags">
    			 <!-- 广告位 index_tags 开始-->
			    <?php echo $data['ad']['index_tags']['intro'];?>
			    <!-- 广告位 index_tags 结束-->
    			</div></div>
    		</div>
    		<div class="main">
    			<div class="m-l">
    				<div class="tit"><a href="/t_weigonglue">精品原创微攻略</a><?php if($data['ad']['index_top_right_img']['link_url']):?><a href="<?php echo $data['ad']['index_top_right_img']['link_url'];?>" target="_blank" class="c1"><?php echo $data['ad']['index_top_right_img']['intro'];?></a><?php endif?></div>
    				<div class="first">
    				<?php if($data['touqiao_post']):?>
						<strong><a href="<?php echo $this->_baseUrl.'/v_'.$data['touqiao_post']['title_alias'];?>"><?php echo mb_substr($data['touqiao_post']['title'],0,22,'UTF-8');?></a></strong>
    					<p><?php echo mb_substr($data['touqiao_post']['intro'],0,40,'UTF-8');?><a href="<?php echo $this->_baseUrl.'/v_'.$data['touqiao_post']['title_alias'];?>" class="txte97">[全文]</a></p>
					<?php endif?>
					</div>
    				<ul>
					<?php foreach((array)$data['yuanchuang_post'] as $key=>$pt):?>
    				<li>
    				<a href="<?php echo $this->_baseUrl.'/'.$pt['catalog_name_alias'];?>"><?php echo $pt['catalog_name_second'];?></a>
    				<a href="<?php echo $this->_baseUrl.'/v_'.$pt['title_alias'];?>"><?php echo mb_substr($pt['title'],0,22,'UTF-8');?></a>
    				</li>
					<?php endforeach?>
    				</ul>
    			</div>
    			<div class="m-r">
    				<div class="app-box">
	    				<div class="tit">微信关注要出发，旅游攻略随身带!</div>
	    				<ul class="app-ul fn-clear">
	    					<li><img src="<?php echo $this->_baseUrl.'/';?>static/gonglv/images/yaochufa-app.png" alt="" width="115" height="115">要出发旅行攻略</li>
	    					<li><img src="<?php echo $this->_baseUrl.'/';?>static/gonglv/images/yaochufa-m.png" alt="" width="115" height="115">m.yaochufa.com</li>
	    				</ul>
    				</div>
    				<div class="activity-box fn-hide">
    					<p class="tit"><a href="">梦幻般的上海童话城堡，好想都去玩一遍！</a></p>
    					<p><a href="http://www.yaochufa.com/package/11438"><img src="http://cdn1.yaochufa.com/images/ProductList466/hl_11438_od_2_c0677657353247c78d86ce9f52649d71.jpg" width="300" height="119"/></a></p>
    					<div class="time-box fn-clear">
    					<div class="colockbox" id="colockbox1"> 
							距结束：<span class="day">00</span>天
							<span class="hour">00</span>小时
							<span class="minute">00</span>分
							<span class="second">00</span>秒
						</div> 
						<a href="" class="btn-signup">立即报名</a>
						</div>
    				</div>
    				<ul class="top-ul">
    				    <?php foreach((array)$data['banners'] as $key=>$pt):?>
    				    <?php if($pt->id):?>
    					<li><a href="<?php echo $pt->url;?>" target="_blank"><?php echo mb_substr($pt->title,0,22,'UTF-8');?></a></li>
    					<?php endif?>
    					<?php endforeach?>
    				</ul>
    			</div>
    		</div>
    	</div>
    	<?php if($data['ad']['index_middle_img_1']['link_url']):?>
    	<div class="topBanner">
            <a href="<?php echo $data['ad']['index_middle_img_1']['link_url']?>" target="_blank"><img src="<?php if($data['ad']['index_middle_img_1']['image_url']):?><?php echo $data['ad']['index_middle_img_1']['image_url'];?><?php else:?><?php echo XUtils::realImageUrl($data['ad']['index_middle_img_1']['attach_file']);?><?php endif?>"></a>
        </div>
        <?php endif;?>
		<div class="focus-area fn-clear">
			<div class="aside">
				<!-- 广告位 index_img_2 开始-->
				<a class="applink" href="<?php echo $data['ad']['index_img_2']['link_url'];?>" target="_blank"><img src="<?php if($data['ad']['index_img_2']['image_url']):?><?php echo $data['ad']['index_img_2']['image_url'];?><?php else:?><?php echo XUtils::realImageUrl($data['ad']['index_img_2']['attach_file'],Yii::app()->params['imagStaticStyle']['220#150']);?><?php endif ?>"  width="230" height="139"></a>
				<!-- 广告位 index_img_2 结束-->
				<a class="go-touch" href="http://m.yaochufa.com">访问要出发触屏版<br/><i>m.yaochufa.com</i></a>
			</div>
			<div class="focus-area-right">
				<div class="recommad-strategy">
				    <!-- 广告位 index_tuijian 开始-->
				    <?php echo $data['ad']['index_tuijian']['intro'];?>
					<!-- 广告位 index_tuijian 开始-->
				</div>
			</div>
		</div>
		<div class="hot-vicinity-strategy clearfix">
			<p class="content-title ">热门城市周边游攻略</p>

			<?php if($data['ip']['post']):?>
			<div class="txt-list clearfix">
				<p class="hot-vicinity-strategy-title"><strong><a href="<?php echo $this->_baseUrl.'/'.$data['ip']['area']['catalog_name_alias'];?>"><?php echo $data['ip']['area']['catalog_name_second'];?>周边游攻略</a></strong></p>
				<ul class="hot-vicinity-strategy-left">
				<?php $ip_arr=array();if($data['ip']['two']):?>
					<?php $i=0;foreach((array)$data['ip']['two'] as $pt):?>
					<?php if($pt['id'] && $i<=1):?>
						<li>
							<a href="<?php echo $this->_baseUrl.'/v_'.$pt['title_alias'];?>">
								<img class="lazy" src="<?php echo Yii::app()->params['imagWhiteBgUrl'];?>" data-original="<?php echo XUtils::realImageUrl($pt['attach_thumb'],Yii::app()->params['imagStaticStyle']['220#150']);?>"  width="220" height="150">
								<p class="description"><?php echo mb_substr($pt['title'],0,15,'UTF-8');?></p>
							</a>
						</li>
					<?php $i++;$ip_arr[]=$pt['id'];endif?>
					<?php endforeach?>
				<?php endif?>
				</ul>
				<ul class="strategy-list hot-vicinity-strategy-right">
				    <?php $i=0;foreach((array)$data['ip']['post'] as $key=>$pt):?>
					<?php if($pt['id'] && !in_array($pt['id'], $ip_arr) && $i<=11):?>
					<li <?php if($i%2==0):?>class="mgright30"<?php endif?>><a href="<?php echo $this->_baseUrl.'/v_'.$pt['title_alias'];?>"><?php echo mb_substr($pt['title'],0,22,'UTF-8');?></a><i class="arrow"></i></li>
					<?php $i++;endif?>
					<?php endforeach?>
				</ul>
				<ul class="hot-vicinity-strategy-bottom product-list clearfix" id="TravelRecom_<?php echo $data['ip']['area']['c_code'];?>">
				</ul>
			</div>
			<?php endif?>

			<?php foreach((array)$data['city'] as $key=>$val):?>
			<?php if($val['post'] && $key != $data['ip']['id']):?>
			<div class="txt-list clearfix">
				<p class="hot-vicinity-strategy-title"><strong><a href="<?php echo $this->_baseUrl.'/'.$val['area']['catalog_name_alias'];?>"><?php echo $val['area']['catalog_name_second'];?>周边游攻略</a></strong></p>
				<ul class="hot-vicinity-strategy-left">
				<?php $ip_arr=array();if($val['two']):?>
					<?php $i=0;foreach((array)$val['two'] as $pt):?>
					<?php if($pt['id'] && $i<=1):?>
						<li>
							<a href="<?php echo $this->_baseUrl.'/v_'.$pt['title_alias'];?>">
								<img class="lazy" src="<?php echo Yii::app()->params['imagWhiteBgUrl'];?>" data-original="<?php echo XUtils::realImageUrl($pt['attach_thumb'],Yii::app()->params['imagStaticStyle']['220#150']);?>"  width="220" height="150">
								<p class="description"><?php echo mb_substr($pt['title'],0,15,'UTF-8');?></p>
							</a>
						</li>
					<?php $i++;$ip_arr[]=$pt['id'];endif?>
					<?php endforeach?>
				<?php endif?>
				</ul>
				<ul class="strategy-list hot-vicinity-strategy-right">
				    <?php $i=0;foreach((array)$val['post'] as $key=>$pt):?>
					<?php if($pt['id'] && !in_array($pt['id'], $ip_arr) && $i<=11):?>
					<li <?php if($i%2==0):?>class="mgright30"<?php endif?>><a href="<?php echo $this->_baseUrl.'/v_'.$pt['title_alias'];?>"><?php echo mb_substr($pt['title'],0,22,'UTF-8');?></a><i class="arrow"></i></li>
					<?php $i++;endif?>
					<?php endforeach?>
				</ul>
				<ul class="hot-vicinity-strategy-bottom product-list clearfix" id="TravelRecom_<?php echo $val['area']['c_code'];?>">
				</ul>
			</div>
			<?php endif?>
			<?php endforeach?>
			<?php $this->widget('application.widget.gonglue.TravelRecom', array('type'=>'default_index','alias'=>$data['city_code'],'num'=>2,'place'=>'city'));?>
			<div class="Corporate_site fn-clear">
				<div class="hot-city-strategy clearfix">
					<?php if($data['hot_city']):?>
					<p class="content-title2">热门城市周边游攻略</p>
	                <p class="box-zhoubian">
	                	<?php foreach((array)$data['hot_city'] as $key=>$newsRow):?>
		            	<a class="city_gonglue" href="<?php echo $this->_baseUrl.'/'.$newsRow['catalog_name_alias'];?>" rel="external" title="<?php echo $newsRow['catalog_name_second']?>原创精品攻略"><?php echo $newsRow['catalog_name_second']?>旅游攻略</a>
		            	<?php endforeach?> 
		        	</p>
		        	<?php endif;?>
				</div>
			</div>
    </div>
    <div class="Corporate_site fn-clear">
			<div class="hot-city-strategy clearfix">
				<p class="content-title2">友情链接</p>
                <p class="box-zhoubian">
                <?php foreach((array)$data['site_link'] as $key=>$newsRow):?>
	            <a target="_blank" class="city_gonglue" href="<?php echo $newsRow['site_url'];?>" rel="external" title="<?php echo $newsRow['site_name']?>"><?php echo $newsRow['site_name']?></a>
	            <?php endforeach?>
                </p>
			</div>
	</div>
</div>
    <?php $this->renderPartial('/_include/footer')?>
</body>
<script type="text/javascript" src="/static/gonglv/js/mySlider.js"></script>
</html>
<?php 
$str=ob_get_contents();
ob_end_clean();
echo XUtils::compress_html($str);

?>