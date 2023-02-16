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
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Create Client User Details</h2>
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
<div class="user-form" style="background:#fff;padding:10px;margin-top:10px;">

	<?php $form = ActiveForm::begin([
		'id'=>'form-profile',
		'layout'=>'horizontal',
		'validateOnBlur' => false,
                'options'=>['enctype'=> 'multipart/form-data'],
	]) ?>
    
    <div class="row">
   
        
        <div class="col-lg-6">
            <?php
             $employees= new \frontend\models\Projectapplications;
                $allemp=$employees->find()->all();
                $employeesnames=ArrayHelper::map($allemp,'client_name','client_name');
                $clients=ArrayHelper::map($allemp,'id','client_name');
            ?>
           
             
              <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
                'data' => $clients,
                'options' => ['placeholder' => 'Select  ...', 'multiple' => false],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 10
                ],
            ]) ?>
        </div>	
    </div>
     <div class="row">
		<div class="col-lg-6">	
                
	        <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
               </div> 
         </div> 
     <div class="row">
   
        
        <div class="col-lg-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
            
        </div>
	  </div>
         
    <div class="form-group" style="margin-left: 150px">
		
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