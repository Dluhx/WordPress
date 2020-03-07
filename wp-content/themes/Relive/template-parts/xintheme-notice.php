<div class="<?php if( xintheme('xintheme-notice-home') ){?>md-show-home<?php }else{?>md-show<?php }?>"<?php if( xintheme('xintheme-notice-cookie') ){?> id="xintheme-notice"<?php }?>>
	<div class="pop-overlay"></div>
	<div class="fadeIn-<?php echo xintheme('notice_fadein');?> md-container">
		<div class="md-content" style="background: <?php echo xintheme('notice_bg_color');?>">
			<h3><?php echo xintheme('xintheme-notice-title');?></h3>
			<div>
				<?php echo xintheme('xintheme-notice-content');?>
				<br><br>
				<button id="modal-gg-close" class="md-close" onclick="closeNotice()">关闭</button>
			</div>
		</div>
	</div>
</div>
<?php if( xintheme('xintheme-notice-cookie') ){?>
<script>
window.onload = function(){
	if(getCookie("notice")==0){
		document.getElementById("xintheme-notice").style.display="none";
	}else{
		document.getElementById("xintheme-notice").style.display="block";
	}
}
//关闭公告
function closeNotice() {
	document.getElementById("xintheme-notice").style.display="none";
	setCookie("notice","0"); 
}
   
//设置cookie 
function setCookie(name,value){ 
    var exp = new Date();  
    exp.setTime(exp.getTime() + 1*60*60*1000);//有效期1小时 
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
} 
//取cookies函数 
function getCookie(name){ 
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)")); 
    if(arr != null) return unescape(arr[2]); return null; 
} 
</script>
<?php }?>