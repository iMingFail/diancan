<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<!--系统管理首页-->
<div class="welcome-container js-system-welcome" ng-controller="WelcomeCtrl" ng-cloak>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel we7-panel account-stat">
				<div class="panel-heading">微信应用模块</div>
				<div class="panel-body we7-padding-vertical">
					<div class="col-sm-4 text-center">
						<div class="title">未安装应用</div>
						<div class="num">
							<a href="<?php  echo url('system/module/not_installed', array('account_type' => 1))?>" class="color-default">{{account_uninstall_modules_nums}}</a>
						</div>
					</div>
					<div class="col-sm-4 text-center">
						<div class="title">可升级应用</div>
						<div class="num">
						{{upgrade_module_nums.account_upgrade_module_nums}}
						</div>
					</div>
					<div class="col-sm-4 text-center">
						<div class="title">应用总数</div>
						<div class="num">
							<a href="<?php  echo url('system/module/installed', array('account_type' => 1))?>" class="color-default">{{account_modules_total}}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel we7-panel account-stat">
				<div class="panel-heading">小程序应用模块</div>
				<div class="panel-body we7-padding-vertical">
					<div class="col-sm-4 text-center">
						<div class="title">未安装应用</div>
						<div class="num">
							<a href="<?php  echo url('system/module/not_installed', array('account_type' => 4))?>" class="color-default">{{wxapp_uninstall_modules_nums}}</a>
						</div>
					</div>
					<div class="col-sm-4 text-center">
						<div class="title">可升级应用</div>
						<div class="num">
						{{upgrade_module_nums.wxapp_upgrade_module_nums}}
						</div>
					</div>
					<div class="col-sm-4 text-center">
						<div class="title">应用总数</div>
						<div class="num">
							<a href="<?php  echo url('system/module/installed', array('account_type' => 4))?>" class="color-default">{{wxapp_modules_total}}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-loading" style="width:100%">
			<div style="text-align:center;background-color: transparent;">
				<img style="width:48px; height:48px; margin-top:10px;margin-bottom:10px;" src="resource/images/loading.gif" title="正在努力加载...">
			</div>
		</div>
	</div>
	<div class="panel we7-panel system-update" ng-if="upgrade_show == 1">
		<div class="panel-heading">
			<span class="color-gray pull-right">当前版本：<?php echo IMS_FAMILY;?><?php echo IMS_VERSION;?>（<?php echo IMS_RELEASE_DATE;?>）</span>
			系统更新
		</div>
		<div class="panel-body we7-padding-vertical clearfix">
			<div class="col-sm-3 text-center">
				<div class="title">更新文件</div>
				<div class="num">{{upgrade.file_nums}} 个</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="title">更新数据库</div>
				<div class="num">{{upgrade.database_nums}} 项</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="title">更新脚本</div>
				<div class="num">{{upgrade.script_nums}} 项</div>
			</div>
			<div class="col-sm-3 text-center">
				<a href="<?php  echo url('cloud/upgrade');?>" class="btn btn-danger">去更新</a>
			</div>
		</div>
	</div>
	<div class="panel we7-panel database">
		<div class="panel-heading">
			数据库备份提醒
		</div>
		<div class="panel-body clearfix">
			<div class="col-sm-9">
				<span class="day"><?php  echo $backup_days;?></span>
				<span class="color-default">天</span>
				没有备份数据库了,请及时备份!
			</div>
			<div class="col-sm-3 text-center">
				<a class="btn btn-default" href="<?php  echo url('system/database');?>">开始备份</a>
			</div>
		</div>
	</div>
	<div class="panel we7-panel apply-list">
		<div class="panel-heading">
			<span class="pull-right">
				<a href="<?php  echo url('system/module', array('account_type' => 1))?>" class="color-default">查看更多公众号应用</a>
				<span class="we7-padding-horizontal inline-block color-gray">|</span>
				<a href="<?php  echo url('system/module', array('account_type' => 4))?>" class="color-default">查看更多小程序应用</a>
			</span>
			可升级应用
		</div>
		<div class="panel-body">
			<a href="{{module.link}}" target="_blank" class="apply-item" ng-repeat="module in upgrade_module_list">
				<img src="{{module.logo}}" class="apply-img"/>
				<span class="text-over">{{module.title|limitTo:4}}</span>
				<span class="color-red">升级</span>
			</a>
			<div class="text-center" ng-if="upgrade_modules_show == 0">
				没有可升级的应用
			</div>
		</div>
	</div>
</div>
<!--end 系统管理首页-->
<script type="text/javascript">
	$(function(){
		angular.module('systemApp').value('config', {
			notices: <?php echo !empty($notices) ? json_encode($notices) : 'null'?>,
			systemUpgradeUrl : "<?php  echo url('home/welcome/get_system_upgrade')?>",
			upgradeModulesUrl: "<?php  echo url('home/welcome/get_upgrade_modules')?>",
			moduleStatisticsUrl: "<?php  echo url('home/welcome/get_module_statistics')?>"
		});
		angular.bootstrap($('.js-system-welcome'), ['systemApp']);
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>