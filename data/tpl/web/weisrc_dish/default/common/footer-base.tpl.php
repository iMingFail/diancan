<?php defined('IN_IA') or exit('Access Denied');?>	<script type="text/javascript">
		require(['bootstrap']);
		$('.js-clip').each(function(){
			util.clip(this, $(this).attr('data-url'));
		});
	</script>
	<div class="container-fluid footer" role="footer">
		<div class="page-header"></div>
		<span class="pull-left">
			<p><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.xxx.cc"><b>餐饮</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2015 <a href="http://www.xxx.cc">www.we7.cc</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></p>
		</span>
		<span class="pull-right">
			<p><?php  if(empty($_W['setting']['copyright']['footerright'])) { ?><a href="http://www.xxx.cc">关于餐饮</a>&nbsp;&nbsp;<a href="http://bbs.we7.cc">餐饮论坛</a>&nbsp;&nbsp;<a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODAwMzEzOV8xNzEwOTZfNDAwMDgyODUwMl8yXw">联系客服</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerright'];?><?php  } ?></p>
		</span>
	</div>
	<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
</body>
</html>
