<?php
/**
 * @var $this yii\web\View
 * @var $user webvimark\modules\UserManagement\models\User
 */
use yii\helpers\Html;

?>
<?php
$generalsettigs= new \frontend\models\Generalsettings();
$setting= $generalsettigs->find()->where(['name'=>'LOGINURL'])->one();
$resetLink =$setting->value; //'http://'.Yii::$app->urlManager->createUrl(['/user-management/auth/login']);
?>
<div>
    <div class="row">
    <h3 style="color: #19C0A0;text-align: center;"> SAHIHI INTERIOR DECORATORS</h3>
    </div>
    <?php if($password!=NULL){ ?>
    <div class="row" style="color: #858585;text-align: center; background-color: #F5F5F5; font-size: 18px; padding: 50px;">
    Hello <?= Html::encode($user) ?>, follow the link below to login to SAHIHI ERP System: <br>
    Your Username is: <?= $user ?>  <br>
    Your Password is:  <?= $password ?><br>

    NB: THE PASSWORD IS AUTO-GENERATED THEREFORE MUST BE CHANGED ON FIRST LOGIN. <br>
    
    <?= Html::a('Login', $resetLink) ?>  <br> <br> <br>
    <?php } else{   if($message==NULL){?>
      <div class="row" style="color: #858585;text-align: center; background-color: #F5F5F5; font-size: 18px; padding: 50px;">
      Hello <?= Html::encode($user) ?>, You have successfully updated your profile. <br>
    <?php } else{ ?>
      <div class="row" style="color: #858585;text-align: center; background-color: #F5F5F5; font-size: 18px; padding: 50px;">
          Hello <?= Html::encode($user) ?>, Your Account has been approved successfully.<br> <?= Html::a('Login', $resetLink) ?>  <br> <br> <br> <br>
      
    <?php } }?>
    Cheers,<br>
    FIDA ERP TEAM!
    
    </div>
</div>