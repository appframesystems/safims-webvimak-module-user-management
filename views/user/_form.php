<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


   
   
/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */

?>

<div class="user-form">

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
                   <?php     if($model->isNewRecord){ ?>
                        <h5><?= UserManagementModule::t('back', 'Upload Profile Picture') ?> <small></small></h5>
                        
                   <?php } ?>
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
                        <?php }  if($model->isNewRecord){
                        echo $form->field($model, 'profilepic')->fileInput();
                        
                        
                        } ?>
                    </div>
                </div>
            </div>
        
        <div class="col-lg-8">
            <?php
             $employees= new \frontend\modules\humanresource\models\Employee();
                $allemp=$employees->find()->all();
                $employeesnames=ArrayHelper::map($allemp,'name','name');
                $employees=ArrayHelper::map($allemp,'employee_id','name');
            ?>
                <?= $form->field($model->loadDefaultValues(), 'status')
		->dropDownList(User::getStatusList()) ?>
            
             
              <?= $form->field($model, 'employeeid')->widget(Select2::classname(), [
                'data' => $employees,
                'options' => ['placeholder' => 'Select  ...', 'multiple' => false],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 10
                ],
            ]) ?>
			
		
			
                
            <?php $listData=[0=>'False',1=>'True'];

            echo $form->field($model, 'superadmin')->dropDownList(
            $listData,
            ['prompt'=>'Select...']);  
            ?>  
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
					'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save', 'update'),
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