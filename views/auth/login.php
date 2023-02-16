<?php
/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<style>
  
    .btn-primary {
    color: #fff;
    background-color: #77267C !important;
    border-color: #77267C !important;
}
    
</style>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <?php if (Yii::$app->session->getFlash('error') !== NULL){ ?>

            <div class="alert alert-danger"><?=  Yii::$app->session->getFlash('error'); ?></div>

            <?php } ?>
            <?php if (Yii::$app->session->getFlash('success') !== NULL){ ?>

            <div class="alert alert-success"><?=  Yii::$app->session->getFlash('success'); ?></div>

            <?php } ?>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="container" id="login-wrapper">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
                                    
        <h3 style="text-align: center; color: #77267C;" class="panel-title"><?= UserManagementModule::t('front', 'SAFIMS') ?></h3>

            <img style="margin-left: 20%;margin-top: 10px;height:100px;width:200px"  src="<?= Yii::$app->getUrlManager()->getBaseUrl().'/uploads/photos/sahihi_logo.png'?>"/>
             </div>
				<div class="panel-body">

					<?php $form = ActiveForm::begin([
						'id'      => 'login-form',
						'options'=>['autocomplete'=>'off'],
						'validateOnBlur'=>false,
						'fieldConfig' => [
							'template'=>"{input}\n{error}",
						],
					]) ?>

					<?= $form->field($model, 'username')
						->textInput(['placeholder'=>$model->getAttributeLabel('username'), 'autocomplete'=>'off']) ?>

					<?= $form->field($model, 'password')
						->passwordInput(['placeholder'=>$model->getAttributeLabel('password'), 'autocomplete'=>'off']) ?>
                                           <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> <?= Html::label('Show password', 'reveal-password') ?>
                                   
					<?= (isset(Yii::$app->user->enableAutoLogin) && Yii::$app->user->enableAutoLogin) ? $form->field($model, 'rememberMe')->checkbox(['value'=>true]) : '' ?>

					<?= Html::submitButton(
						UserManagementModule::t('front', 'Login'),
						['class' => 'btn btn-lg btn-primary btn-block']
					) ?>

					
                                       <?php
                             $this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#loginform-password').attr('type',this.checked?'text':'password');})");
                             ?>



					<?php ActiveForm::end() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$css = <<<CSS
html, body {
	background: #eee;
	-webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	height: 100%;
	min-height: 100%;
	position: relative;
}
#login-wrapper {
	position: relative;
	top: 30%;
}
#login-wrapper .registration-block {
	margin-top: 15px;
}
CSS;

$this->registerCss($css);
?>