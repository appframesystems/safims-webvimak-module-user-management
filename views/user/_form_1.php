<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

   
   
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */

//get board positions

?>

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Edit Profile</h2>
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

<div style="margin-top: 10px;background-color: #fff; padding: 10px;" class="user-form">

	<?php $form = ActiveForm::begin([
		'id'=>'form-profile',
		'layout'=>'horizontal',
		'validateOnBlur' => false,
                'options'=>['enctype'=> 'multipart/form-data'],
	]) ?>
    
    <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title  back-change">
                        <h5>Upload Profile Picture <small></small></h5>
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
                        
                        <?php if($model->profilepic) {   ?>
                         
                        <div class="profile-image">
                        <img src="<?=Yii::$app->getUrlManager()->getBaseUrl().'/'.$model->profilepic?>" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                        <?php } ?>
                    
                       <?php echo $form->field($model, 'profilepic')->fileInput() ?>
                        
                    </div>
                </div>
            </div>
        
        <div class="col-lg-8">
            
                
                <?= $form->field($model, 'fullnames')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
                
	        <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
                
                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
	       
            
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<?php if ( $model->isNewRecord ): ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-plus-sign"></span> ' . UserManagementModule::t('back', 'Create'),
					['class' => 'btn btn-success']
				) ?>
			<?php else: ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save'),
					['class' => 'btn btn-primary']
				) ?>
			<?php endif; ?>
		</div>
	</div>
            
        </div>
        </div>

	
    




	<?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>

 
 


<?php
$js = <<<JS
        
        $(document).ready(function(){
       function readUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        
        });
JS;
 
$this->registerJs($js);
?>