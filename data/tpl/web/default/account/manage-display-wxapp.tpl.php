<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">小程序管理</div>
<ul class="we7-page-tab">
	<li class="active"><a href="<?php  echo url ('account/manage', array('account_type' => '4'))?>">小程序列表</a></li>
	<?php  if($_W['role'] == ACCOUNT_MANAGE_NAME_OWNER || $_W['role'] == ACCOUNT_MANAGE_NAME_FOUNDER) { ?>
	<li><a href="<?php  echo url ('account/recycle', array('account_type' => '4'))?>">小程序回收站</a></li>
	<?php  } ?>
</ul>
<div class="clearfix we7-margin-bottom">
	<?php  if(!$_W['isfounder'] && !empty($account_info['uniacid_limit'])) { ?>
		<div class="alert alert-warning">
			温馨提示：
			<i class="fa fa-info-circle"></i>
			Hi，<span class="text-strong"><?php  echo $_W['username'];?></span>，您所在的会员组： <span class="text-strong"><?php  echo $account_info['group_name'];?></span>，
			账号有效期限：<span class="text-strong"><?php  echo date('Y-m-d', $_W['user']['starttime'])?> ~~ <?php  if(empty($_W['user']['endtime'])) { ?>无限制<?php  } else { ?><?php  echo date('Y-m-d', $_W['user']['endtime'])?><?php  } ?></span>，
			可创建 <span class="text-strong"><?php  echo $account_info['maxwxapp'];?> </span>个小程序，已创建<span class="text-strong"> <?php  echo $account_info['wxapp_num'];?> </span>个，还可创建 <span class="text-strong"><?php  echo $account_info['wxapp_limit'];?> </span>个小程序。
		</div>
	<?php  } ?>
	<form action="" class="form-inline  pull-left" method="get">
		<input type="hidden" name="c" value="account">
		<input type="hidden" name="a" value="manage">
		<input type="hidden" name="account_type" value="4">
		<div class="input-group form-group" style="width: 400px;">
			<input type="text" name="keyword" value="<?php  echo $_GPC['keyword'];?>" class="form-control" placeholder="搜索关键字"/>
			<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search"></i></button></span>
		</div>
	</form>
	<?php  if(!empty($account_info['uniacid_limit']) || $_W['isfounder']) { ?>
	<div class="pull-right">
		<a href="<?php  echo url('wxapp/post/design_method')?>" class="btn btn-primary we7-padding-horizontal">添加小程序</a>
	</div>
	<?php  } ?>
</div>
<table class="table we7-table table-hover vertical-middle table-manage" id="js-system-account-display" ng-controller="SystemAccountDisplay" ng-cloak>
	<col width="120px" />
	<col />
	<col width="208px" />
	<col width="245px" />
	<tr>
		<th colspan="2" class="text-left">小程序应用</th>
		<th>有效期</th>
		<th class="text-right">操作</th>
	</tr>
	<tr class="color-gray" ng-repeat="list in lists">
		<td class="text-left">
			<img ng-src="{{list.thumb}}" class="img-responsive icon">
		</td>
		<td class="text-left">
			<p class="color-dark" ng-bind="list.name"></p>
		</td>
		<td>
			<p ng-bind="list.setmeal.timelimit"></p>
		</td>
		<td class="vertical-middle">
			<div class="link-group">
				<a ng-href="{{links.switch}}uniacid={{list.uniacid}}">进入小程序</a>
				<?php  if($_W['role'] == ACCOUNT_MANAGE_NAME_FOUNDER || $_W['role'] == ACCOUNT_MANAGE_NAME_OWNER || $_W['role'] == ACCOUNT_MANAGE_NAME_MANAGER) { ?>
					<a ng-href="{{links.post}}&acid={{list.acid}}&uniacid={{list.uniacid}}" ng-show="list.role == 'manager' || list.role == 'owner' || list.role == 'founder'">管理设置</a>
					<?php  if($_W['role'] != ACCOUNT_MANAGE_NAME_MANAGER) { ?>
					<a ng-href="{{links.del}}&acid={{list.acid}}&uniacid={{list.uniacid}}" ng-show="list.role == 'owner' || list.role == 'founder'" onclick="if(!confirm('确认放入回收站吗？')) return false;" class="del">停用</a>
					<?php  } ?>
				<?php  } ?>
			</div>
		</td>
	</tr>
</table>
<div class="text-right">
	<?php  echo $pager;?>
</div>
<script>
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	switch_url = "<?php  echo url('wxapp/display/switch')?>";
	angular.module('accountApp').value('config', {
		lists: <?php echo !empty($list) ? json_encode($list) : 'null'?>,
		links: {
			switch: switch_url,
			post: "<?php  echo url('account/post', array('account_type' => ACCOUNT_TYPE_APP_NORMAL))?>",
			del: "<?php  echo url('account/manage/delete', array('account_type' => ACCOUNT_TYPE_APP_NORMAL))?>",
		}
	});
	angular.bootstrap($('#js-system-account-display'), ['accountApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>