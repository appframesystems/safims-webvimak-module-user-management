<?php
use app\assets\AppAsset;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$this->title = UserManagementModule::t('front', 'Authorization');
BootstrapAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
            <style>
           body{
    background-image: url('../../images/sahihi.png');
    background-size:cover;
    
} 
</style>
    
</head>
<body>

<?php $this->beginBody() ?>
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
<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>