<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb we7-breadcrumb">
	<a href="<?php  echo url('user/display');?>"><i class="wi wi-back-circlewi wi-back-circle"></i> </a>
	<li><a href="<?php  echo url('user/display');?>">用户管理</a></li>
	<li>编辑用户详情</li>
</ol>
<div id="js-user-edit-account" ng-controller="UserEditAccount" ng-cloak>
	<div class="user-head-info" >

		<img ng-src="{{profile.avatar}}" class="img-circle user-avatar pull-left">
		<h3 class="pull-left" ng-bind="user.username"></h3>
		<div class="user-edit pull-right">
			<a href="<?php  echo url('user/display/recycle', array('uid' => $_GPC['uid']))?>" class="btn btn-primary">禁用</a>
		</div>
	</div>
	<div class="btn-group we7-btn-group we7-padding-bottom">
		<a href="<?php  echo url('user/edit/edit_base', array('uid' => $_GPC['uid']))?>" class="btn btn-default">基础信息</a>
		<a href="<?php  echo url('user/edit/edit_modules_tpl', array('uid' => $_GPC['uid']))?>" class="btn btn-default">应用模板权限</a>
		<a href="<?php  echo url('user/edit/edit_account', array('uid' => $_GPC['uid']))?>" class="btn btn-default active">使用账号列表</a>
	</div>
	<table class="table we7-table table-hover vertical-middle">
		<col width="87px"/>
		<col/>
		<col width="100px"/>
		<col width="240px"/>
		<tr>
			<th colspan="2" class="text-left">可使用的公众号</th>
			<th>角色</th>
			<th class="text-right">操作</th>
		</tr>
		<tr ng-repeat="wechat in wechats" ng-if="wechats">
			<td class="text-left"><img ng-src="{{wechat.thumb}}" class="img-responsive"/></td>
			<td class="text-left">
				<p ng-bind="wechat.name"></p>
				<span class="color-gray">类型：
					<span ng-if="wechat.level == 1">普通订阅号</span>
					<span ng-if="wechat.level == 2">普通服务号</span>
					<span ng-if="wechat.level == 3">认证订阅号</span>
					<span ng-if="wechat.level == 4">认证服务号/认证媒体/政府订阅号</span>
				</span>
			</td>
			<td>
				<span ng-if="wechat.role == 'founder'">创始人</span>
				<span ng-if="wechat.role == 'owner'">主管理员</span>
				<span ng-if="wechat.role == 'manager'">管理员</span>
				<span ng-if="wechat.role == 'operator'">操作员</span>
				<span ng-if="wechat.role == 'clerk'">店员</span>
			</td>
			<td>
				<div class="link-group">
					<a ng-href="./index.php?c=account&a=post&do=base&uniacid={{wechat.uniacid}}&acid={{wechat.acid}}&account_type=<?php echo ACCOUNT_TYPE_OFFCIAL_NORMAL;?>" class="color-default">公众号设置</a>
					<a ng-href="./index.php?c=account&a=post-user&do=edit&uniacid={{wechat.uniacid}}&acid={{wechat.acid}}&account_type=<?php echo ACCOUNT_TYPE_OFFCIAL_NORMAL;?>" class="color-default">操作员设置</a>
				</div>
			</td>
		</tr>
		<tr ng-if="!wechats">
			<td colspan="4" class="text-center">暂无数据</td>
		</tr>
	</table>
	<table class="table we7-table table-hover">
		<col width="87px"/>
		<col/>
		<col width="100px"/>
		<col width="240px"/>
		<tr>
			<th colspan="2" class="text-left">可使用的小程序</th>
			<th>角色</th>
			<th class="text-right">操作</th>
		</tr>
		<tr ng-repeat="wxapp in wxapps" ng-if="wxapp">
			<td class="text-left"><img ng-src="{{wxapp.thumb}}" class="img-responsive"/></td>
			<td class="text-left">
				<p ng-bind="wxapp.name"></p>
				<span class="color-gray">类型：
					<span>小程序</span>
				</span>
			</td>
			<td>
				<span ng-if="wxapp.role == 'founder'">创始人</span>
				<span ng-if="wxapp.role == 'owner'">主管理员</span>
				<span ng-if="wxapp.role == 'manager'">管理员</span>
				<span ng-if="wxapp.role == 'operator'">操作员</span>
				<span ng-if="wxapp.role == 'clerk'">店员</span>
			</td>
			<td>
				<div class="link-group">
					<a ng-href="./index.php?c=account&a=post&do=base&uniacid={{wxapp.uniacid}}&acid={{wxapp.acid}}&account_type=<?php echo ACCOUNT_TYPE_APP_NORMAL;?>" class="color-default">小程序设置</a>
					<a ng-href="./index.php?c=account&a=post-user&do=edit&uniacid={{wxapp.uniacid}}&acid={{wxapp.acid}}&account_type=<?php echo ACCOUNT_TYPE_APP_NORMAL;?>" class="color-default">操作员设置</a>
				</div>
			</td>
		</tr>
		<tr ng-if="!wxapps">
			<td colspan="4" class="text-center">暂无数据</td>
		</tr>
	</table>
</div>
<script>
	angular.module('userManageApp').value('config', {
		user: <?php echo !empty($user) ? json_encode($user) : 'null'?>,
		wechats: <?php echo !empty($account_detail['wechat']) ? json_encode($account_detail['wechat']) : 'null'?>,
		wxapps: <?php echo !empty($account_detail['wxapp']) ? json_encode($account_detail['wxapp']) : 'null'?>,
		profile: <?php echo !empty($profile) ? json_encode($profile) : 'null'?>,
	});

	angular.bootstrap($('#js-user-edit-account'), ['userManageApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>