<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use webvimark\modules\UserManagement\UserManagementModule;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\document\models\DocumentManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Approve Users';
$this->params['breadcrumbs'][] = ['label' => 'Approve'];
//$this->params['breadcrumbs'][] = ['label' => $model->document_id, 'url' => ['view', 'id' => $model->document_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                          
                           <?php  echo \yii\helpers\Html::a( 'Back', Yii::$app->request->referrer,['class'=>'btn btn-primary btn-md']);?> 
                           
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                          <table class="table" data-paging="true" data-filtering="true">
	<thead>
	<tr>
		<th data-breakpoints="xs sm md"><?= UserManagementModule::t('back', 'Name') ?></th>
		<th><?= UserManagementModule::t('back', 'Username') ?></th>
		<th><?= UserManagementModule::t('back', 'Email') ?></th>
		<th data-breakpoints="xs"><?= UserManagementModule::t('back', 'Phone') ?></th>
		<!--<th data-breakpoints="xs sm">Created On</th>-->
		<th data-type="html" data-breakpoints="xs sm md"><?= UserManagementModule::t('back', 'Action') ?></th>
	</tr>
	</thead>
	<tbody>
            <?php foreach($model as $user){   ?>
	<tr>
		<td><?=$user['fullnames']?></td>
		<td><?=$user['username']?></td>
		<td><?=$user['email']?></td>
		<td><?=$user['phone']?></td>
                <td>  <?= Html::a('Approve', ['actualapproveuser','id'=>$user['id']], ['class'=>'btn btn-primary btn-xs']) ?></td>
	</tr>
            <?php } ?>
	</tbody>
</table>  
                        </div>
                    </div>
                </div>
            </div>
 <!-- Page-Level Scripts -->
   <?php
$js = <<<JS

 $(document).ready(function() {
       
    $('.table').footable();
        
});

JS;
 
$this->registerJs($js);
?>