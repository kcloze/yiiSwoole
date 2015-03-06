<div class="menuCont fn-hide">
    	<div class="city-content fn-hide"> <span class="arrow-up"></span>
    	<?php foreach((array)$this->_topProvinces as $key=>$city):?>
		<dl class="clearfix">
			<dt><?php echo $key;?></dt>
			<dd>
			<?php foreach((array)$city as $k=>$val):?>
				<span><a href="<?php echo Yii::app()->params['webUrl'].$val[0];?>"><?php echo $val[1];?></a></span>
			<?php endforeach?>
			</dd>
		</dl>
	    <?php endforeach?>
        </div>
    </div>
<div class="foot">
        <div class="footer">
            <div class="rowone">
              <div class="l1"></div>
              <div class="r1"><p>
                  <a href="http://about.yaochufa.com/aboutUs">关于我们</a>|<a href="http://about.yaochufa.com/service">品质承诺</a>|<a href="http://about.yaochufa.com/joinus">招聘信息</a>|<a href="http://about.yaochufa.com/contact">联系我们</a>|<a href="http://about.yaochufa.com/ycf_news">新闻动态</a>|<a href="http://about.yaochufa.com/help_yuding">帮助中心</a>|<a href="http://you.yaochufa.com/sitemap">网站地图</a>
                </p>
                 <p>
                 <a href="http://cdn1.yaochufa.com/images/about/Telecom_ICP.jpg" target="_blank">中华人民共和国增值电信业务经营许可证 <span>经营许可证编号：粤B2-20130613</span></a>
                 </p>
                  <p class="copyright">版权所有 © 广州酷旅旅行社有限公司 2009-<?php echo date('Y');?><a href="http://www.miitbeian.gov.cn/" rel="external" target="_blank"> 粤ICP备11008339号</a></p>
              </div>
            </div>

            <div class="rowtwo">
              <div class="l2"></div>
              <div class="r2">
                <!-- <span class="footlink1"></span> -->
                <span class="footlink3"></span>
                <!-- <span class="footlink4"></span> -->
                <span>
                	<a target="_blank" href="http://netadreg.gzaic.gov.cn/ntmm/WebSear/WebLogoPub.aspx?logo=440106106012011101200878">
                		<img alt="" src="<?php //echo $this->_baseUrl;?>/static/gonglv/images/logo_down.jpg" style="width:36px; height:36px;"/>
                	</a>
                </span>
              	<span class="footlink5">
                    <a id='___szfw_logo___' href='https://search.szfw.org/cert/l/CX20140912005110005176' target='_blank'>
                        <img src="http://cdn.yaochufa.com/images/cert.jpg" style="width: auto; height: 36px;"/>
                    </a>
                </span>
                <span class="footlink5">
                    <a id="___kxwz_logo___" href='https://ss.knet.cn/verifyseal.dll?sn=e1409174401005395210ye000000' target='_blank'>
                        <img src="http://cdn.yaochufa.com/images/kexin.png" style="width: auto; height: 36px;"/>
                    </a>
                </span>

              </div>
              <script type='text/javascript'>    (function () { document.getElementById('___szfw_logo___').oncontextmenu = function () { return false; } })();</script>
              <script type='text/javascript'>    (function () { document.getElementById('___kxwz_logo___').oncontextmenu = function () { return false; } })();</script>
            </div>
        </div>
    </div>
<script type="text/javascript" src="/static/gonglv/js/base.js?v=<?php echo $this->_static_version;?>"></script>
<script type="text/javascript" src="/static/gonglv/js/newGlobal.js?v=<?php echo $this->_static_version;?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
	if($(".lazy").length>0){
		$("img.lazy").lazyload({effect:"fadeIn"});
	}

  	$('#txtSearchKey').keyup(function(){
		var value = $(this).val();
		value = value.replace(/[~'!<>@#$%^&*()+_=:\"\-\|\\\/¨¦]/g, "");
		value = $.trim(value);
		var len = value.length;
		var alias = encodeURI(value);
		var str =  '<ul><li class="s-more"><a href="http://you.yaochufa.com/to_j_'+alias+'"><i class="icon_spots"></i>搜索“<span class="keyword text_flow">'+value+'</span>”相关景点</a></li>'+
					   '<li class="s-more"><a href="http://you.yaochufa.com/to_g_'+alias+'"><i class="icon_gl"></i>搜索“<span class="keyword text_flow">'+value+'</span>”相关攻略</a></li>'+
					   '<li class="s-more"><a href="http://s.yaochufa.com/k_'+alias+'"><i class="icon_hotel"></i>搜索“<span class="keyword text_flow">'+value+'</span>”相关套餐</a></li>'+
					   '<li class="s-more"><a href="http://you.yaochufa.com/to_z_'+alias+'"><i class="icon_attr_list"></i>搜索“<span class="keyword text_flow">'+value+'</span>”更多相关内容</a></li></ul>';
		if(len <= 0){
			$('#hKwordCon').html('').css('display','none');
		}else if(len == 1){
			$('#hKwordCon').html(str).css('display','block');
		}else{
			$.getJSON("<?php echo Yii::app()->createUrl('ajax/search')?>", { value:alias}, function(data){
				if(data.type == 1){
					var app_html='<ul>';
					if(data.city){
						$.each(data.city, function(i_e,item_e){
				            app_html += '<li><a href="http://you.yaochufa.com'+item_e.url+'"><i class="icon_des"></i>'+item_e.name+'</a></li>';
				        });
					}
					if(data.spot){
						var $i = 0;
						$.each(data.spot, function(i_e,item_e){
							if(i_e > 9) return false;
				            app_html += '<li><a href="http://you.yaochufa.com'+item_e.url+'"><i class="icon_spots"></i>'+item_e.name+'</a></li>';
				        });
					}
					if(app_html.length >5) app_html += '<li class="divider"></li>';
					app_html += str;
					$('#hKwordCon').html(app_html).css('display','block');
				}else{
					$('#hKwordCon').html(str).css('display','block');
				}
			});
		}
	});

	$('#buttonJump').click(function(){
		var value = $('#txtSearchKey').val();
		value = value.replace(/[~'!<>@#$%^&*()+_=:\"\-\|\\\/¨¦]/g, "");
		value = $.trim(value);
		if(value=='目的地，酒店，景点关键字' || value.length < 1)
		{
			window.location.href='/search';
		}else{
			window.location.href='/to_z_'+encodeURI(value);
		}
	});
  });
</script>
<?php if(YII_ENV!='development'){?>
  <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F51a8cfa1a54e5012b018dcef320fa732' type='text/javascript'%3E%3C/script%3E"));
</script>
<div class="fn-hide">
<script type="text/javascript">
var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cspan id='cnzz_stat_icon_1000465838'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/z_stat.php%3Fid%3D1000465838' type='text/javascript'%3E%3C/script%3E"));
</script></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"slide":{"type":"slide","bdImg":"0","bdPos":"right","bdTop":"100"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<?php  }?>

