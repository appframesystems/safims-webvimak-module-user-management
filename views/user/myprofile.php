<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!DOCTYPE html>

             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>My Profile</h2>
<!--                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Extra Pages</a>
                        </li>
                        <li class="active">
                            <strong>Profile</strong>
                        </li>
                    </ol>-->
                </div>
                <div class="col-lg-2">

                </div>
            </div>

            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="<?=Yii::$app->getUrlManager()->getBaseUrl().'/'.$model->profilepic?>" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?= $model->fullnames ?>
                                </h2>
                                <h4><?php //$model->boardposition ?></h4>
                                <small>
                                  <?php //$model->boarddesc ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="panel panel-default">
		<div class="panel-body">

		    <p>
			<?= GhostHtml::a(UserManagementModule::t('back', 'Edit'), ['selfupdate', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
			<?= GhostHtml::a(UserManagementModule::t('back', 'Change Password'), ['/user-management/auth/change-own-password', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                        <?= GhostHtml::a(UserManagementModule::t('back', 'Add/View beneficiaries'), ['/humanresource/beneficiaries/create', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
			 <?= GhostHtml::a(UserManagementModule::t('back', 'View JDs'), ['/jds/index', 'id' => $model->employee_id], ['class' => 'btn btn-sm btn-info']) ?>
			 <?= GhostHtml::a(UserManagementModule::t('back', 'View P4Gs'), ['/p4g/index', 'id' => $model->employee_id], ['class' => 'btn btn-sm btn-warning']) ?>
			
		    </p>

			<?= DetailView::widget([
				'model'      => $model,
				'attributes' => [
				       'id',
                                      'fullnames',
                                     // 'phone',
                                      'passexpirydate',
					[
						'attribute'=>'status',
						'value'=>User::getStatusValue($model->status),
					],
					'username',
					[
						'attribute'=>'email',
						'value'=>$model->email,
						'format'=>'email',
						'visible'=>User::hasPermission('viewUserEmail'),
					],
					[
						'attribute'=>'email_confirmed',
						'value'=>$model->email_confirmed,
						'format'=>'boolean',
						'visible'=>User::hasPermission('viewUserEmail'),
					],
					[
						'label'=>UserManagementModule::t('back', 'Roles'),
						'value'=>implode('<br>', ArrayHelper::map(Role::getUserRoles($model->id), 'name', 'description')),
						'visible'=>User::hasPermission('viewUserRoles'),
						'format'=>'raw',
					],
					
					array(
						'attribute'=>'registration_ip',
						'value'=>Html::a($model->registration_ip, "http://ipinfo.io/" . $model->registration_ip, ["target"=>"_blank"]),
						'format'=>'raw',
						'visible'=>User::hasPermission('viewRegistrationIp'),
					),
					'created_at:datetime',
					'updated_at:datetime',
				],
			]) ?>

		</div>
	</div>
                </div>
               


            </div>
            

    <script>
        $(document).ready(function() {


            $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 48], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#1ab394',
                fillColor: "transparent"
            });


        });
    </script>

</body>

</html>
