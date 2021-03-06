<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb we7-breadcrumb">
	<div class="we7-page-title">我的账户</div>
</ol>
<div id="js-user-profile" ng-controller="UserProfileDisplay" ng-cloak>
	<?php  if(!$_W['isfounder']) { ?>
	<div class="user-head-info we7-padding-bottom" >
		<img ng-src="{{profile.avatar}}" class="img-circle user-avatar pull-left">
		<h3 class="pull-left" ng-bind="user.username"></h3>
	</div>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#base" aria-controls="base" role="tab" data-toggle="tab">基础信息</a></li>
		<li role="presentation"><a href="#modules_tpl" aria-controls="modules_tpl" role="tab" data-toggle="tab">应用模板权限</a></li>
		<li role="presentation"><a href="#account" aria-controls="account" role="tab" data-toggle="tab">使用账号列表</a></li>
	</ul>
	<?php  } ?>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="base">
			<table class="table we7-table table-hover table-form">
				<col width="140px " />
				<col />
				<col width="100px" />
				<tr>
					<th class="text-left" colspan="3">账户设置设置</th>
				</tr>
				<tr>
					<td class="table-label">头像</td>
					<td><img ng-src="{{profile.avatar}}" class="img-circle" width="65px" height="65px" /></td>
					<td><div class="link-group"><a href="javascript:;" ng-click="changeAvatar()">修改</a></div></td>
				</tr>
				<tr>
					<td class="table-label">用户名</td>
					<td ng-bind="user.username"></td>
					<td><div class="link-group"><a href="#name" data-toggle="modal" data-target="" ng-click="editInfo('username', user.username)">修改</a></div></td>
				</tr>
				<tr>
					<td class="table-label">密码</td>
					<td>******</td>
					<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#pass">修改</a></div></td>
				</tr>
			</table>
			<div class="modal fade" id="name" role="dialog">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">修改用户名</div>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input type="text" ng-model="userOriginal.username" class="form-control" placeholder="用户名" />
								<span class="help-block"></span>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" ng-click="httpChange('username')">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="pass" role="dialog">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">修改密码</div>
						</div>
						<div class="modal-body text-center">
							<div class="we7-form" style="width: 450px; margin: 0 auto;">
								<div class="form-group">
									<label for="" class="control-label col-sm-2">原密码</label>
									<div class="form-controls col-sm-10">
										<input type="password" value="" class="form-control old-password">

									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">新密码</label>
									<div class="form-controls col-sm-10">
										<input type="password" value="" class="form-control new-password">

									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">确认新密码</label>
									<div class="form-controls col-sm-10">
										<input type="password" value="" class="form-control renew-password">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" ng-click="httpChange('password')">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
			<table class="table we7-table table-hover table-form">
				<col width="140px " />
				<col />
				<col width="100px" />
				<tr>
					<th class="text-left" colspan="3">基础信息</th>
				</tr>
				<tr>
					<td class="table-label">真实姓名</td>
					<td ng-bind="profile.realname"></td>
					<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#realname" ng-click="editInfo('realname', profile.realname)">修改</a></div></td>
				</tr>
				<tr>
					<td class="table-label">出生年月日</td>
					<td ng-bind="profile.births"></td>
					<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#birth">修改</a></div></td>
				</tr>
				<tr>
					<td class="table-label">邮寄地址</td>
					<td ng-bind="profile.address"></td>
					<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#address" ng-click="editInfo('address', profile.address)">修改</a></div></td>
				</tr>
				<tr>
					<td class="table-label">居住地址</td>
					<td ng-bind="profile.resides"></td>
					<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#reside">修改</a></div></td>
				</tr>
				<tr>
					<td class="table-label">上次登录时间</td>
					<td ng-bind="user.last_visit"></td>
					<td></td>
				</tr>
				<tr>
					<td class="table-label">上次登录IP</td>
					<td ng-bind="user.lastip"></td>
					<td></td>
				</tr>
			</table>
			<div class="modal fade" id="realname" role="dialog">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">修改真实姓名</div>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control" ng-model="userOriginal.realname">
								<span class="help-block">请填写真实姓名</span>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" ng-click="httpChange('realname')">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="birth" role="dialog">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">修改出生年月日</div>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<?php  echo tpl_fans_form('birth',$profile['birth']);?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" ng-click="httpChange('birth')">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="address" role="dialog">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">修改邮寄地址</div>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input class="form-control" type="text" ng-model="userOriginal.address">
								<span class="help-block">请填写详细地址</span>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" ng-click="httpChange('address')">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="reside" role="dialog">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">修改居住地址</div>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<?php  echo tpl_fans_form('reside',$profile['reside']);?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" ng-click="httpChange('reside')">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php  if(!$_W['isfounder']) { ?>
		<div role="tabpanel" class="tab-pane" id="modules_tpl">
			<div class="panel we7-panel user-permission">
				<div class="panel-heading">
					<span>所属用户组：<span ng-bind="group_info.name"></span></span>
				</div>
				<div class="panel-body" ng-repeat="pack in group_info.module_and_tpl">
					<div class="permission-heading">
						<span ng-bind="pack.name"></span>
						<div class="pull-right permission-edit" ng-style="{'width': 'auto'}">
							<a href="javascript:;" class="color-default js-unfold" data-toggle="collapse" data-target="#demo-{{pack.id}}" ng-click="changeText($event)">展开</a>
						</div>
					</div>
					<table id="demo-{{pack.id}}" class="table we7-table table-hover collapse" ng-if="pack.id != '-1'">
						<col width="90px" />
						<col width="835px" />
						<tr class="permission-apply">
							<td class="vertical-middle">应用</td>
							<td><ul><li><span class="label label-success">系统模块</span></li><li ng-repeat="module in pack.modules"><span class="label label-info" ng-bind="module.title"></span></li></ul></td>
						</tr>
						<tr class="permission-template">
							<td class="vertical-middle">模板</td>
							<td><ul><li><span class="label label-success">系统默认模板</span></li><li ng-repeat="tpl in pack.templates"><span class="label label-info" ng-bind="tpl.title"></span></li></ul></td>
						</tr>
					</table>
					<table id="demo-{{pack.id}}" class="table we7-table table-hover collapse" ng-if="pack.id == -1">
						<col width="90px" />
						<col width="835px" />
						<tr class="permission-apply">
							<td class="vertical-middle">应用</td>
							<td><ul><li><span class="label label-danger">系统所有模块</span></li></ul></td>
						</tr>
						<tr class="permission-template">
							<td class="vertical-middle">模板</td>
							<td><ul><li><span class="label label-danger">系统所有模板</span></li></ul></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="account">
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
						<div class="link-group" ng-if="wechat.role == 'owner'">
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
						<div class="link-group" ng-if="wechat.role == 'owner'">
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
		<?php  } ?>
	</div>
</div>
<script>
require(['underscore'], function(){
	angular.module('userProfile').value('config', {
		user: <?php echo !empty($user) ? json_encode($user) : 'null'?>,
		profile: <?php echo !empty($profile) ? json_encode($profile) : 'null'?>,
		group_info: <?php echo !empty($group_info) ? json_encode($group_info) : 'null'?>,
		groups: <?php echo !empty($groups) ? json_encode($groups) : 'null'?>,
		wechats: <?php echo !empty($account_detail['wechat']) ? json_encode($account_detail['wechat']) : 'null'?>,
		wxapps: <?php echo !empty($account_detail['wxapp']) ? json_encode($account_detail['wxapp']) : 'null'?>,
		links: {
			userPost: "<?php  echo url('user/profile/post')?>",
		},
	});
	angular.bootstrap($('#js-user-profile'), ['userProfile']);
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>