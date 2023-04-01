<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm $model
 */

$this->title = UserManagementModule::t('back', 'Make Payment');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-own-password">
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
	<h2 class="lte-hide-title">Make Payment</h2>
    </div>
    <div class="col-lg-4"></div>
</div>
	<div class="panel panel-default">
		<div class="panel-body">

			<?php if ( Yii::$app->session->hasFlash('success') ): ?>
				<div class="alert alert-success text-center">
					<?= Yii::$app->session->getFlash('success') ?>
				</div>
			<?php endif; ?>
                    
 <div class="wrapper wrapper-content animated fadeIn">
       <?php
      // ($s);  exit;
       $locations="SELECT * from clients where code='$id'";
       $db=Yii::$app->db1;
        $command=$db->createCommand($locations);
       $company= $command->queryOne(); 
       if($company){
           $companyname=$company['companyname'];
       }else{
        $companyname=NULL;   
       }
      $locations="SELECT * from invoices where company_name='$companyname'";
       $db=Yii::$app->db1;
        $command=$db->createCommand($locations);
       $invoices= $command->queryOne(); 
      $locations="SELECT * from invoices where company_name='$companyname' AND invoice_status=0 AND type='package'";
       $db=Yii::$app->db1;
        $command=$db->createCommand($locations);
       $allinvoices= $command->queryAll(); 
    
        $SQL="SELECT SUM(amount) AS total FROM invoices where company_name='$companyname' AND invoice_status=0 or invoice_status=2 AND type='package'";
       
        $db=Yii::$app->db1;
        $command=$db->createCommand($SQL);
       $sum= $command->queryOne();
      //($sum["total"]);   exit;
        $locations="SELECT * from clients where companyname='".$invoices['company_name']."'";
       $db=Yii::$app->db1;
        $command=$db->createCommand($locations);
       $packages= $command->queryOne();
       if($packages){
           $packag=$packages['package'];
       }else{
         $packag=NULL;  
       }
       
      ?>
     <div class="row">
         
         <div class="col-lg-6">
     <h1>Invoice for package <?=  $company['package'] ?> subscription</h1>
         </div>
         <div class="col-lg-7"></div>
     </div>
            <div class="row">
                                   <div class="col-md-4">
                                              <div class="wrapper wrapper-content animated fadeInRight">
           
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                
                    </div>
                    <div class="ibox-content">
  
                       
                             <div class="row">
                                 <div class="col-md-4"></div>
                                 <div class="col-md-4">
                       <h4>Invoices</h4>  
                       </div>
                                 <div class="col-md-4"></div>
                             </div>
                    <table class="table table-striped table-bordered" >
                    <thead>
                    <tr>
                        <th>Package</th>
                        <th>Amount</th>
                         
                       
                        
                        
                        
                          
                   
                        
                    </tr>
                    </thead>
                    <tbody>
                         <?php foreach($allinvoices as $allinvoices){  ?>
                    <tr>
                        <td><?= $packag ?></td>
                         <td> $ <?= $allinvoices['amount'] ?></td>
                          
                       

                    </tr>
                        <?php } ?>
                    </tbody>
                    
                    </table>
                            TOTAL INVOICE: $ <?= $sum["total"] ?>
                       

                    </div>
                </div>
            </div>
          
        </div>    
                                        
                                        
                                        
                                    </div>
                <div class="col-lg-8">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> NORMAL MPESA PAYMENT</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-3">MPESA EXPRESS CHECKOUT</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">PAYPAL</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active" >
                                <div class="panel-body">
                                <br>
                               
         <div class="col-md-12">
         <figure><img src="<?= Yii::$app->getUrlManager()->getBaseUrl()."/images/mpesa.jpg"?>" alt="" class="img-circle" height="150px" width="150px"></figure>
         </div>
    <?php
    $mpesapay=$sum["total"] * 100; 
    
    
    ?>
      <h4>Paying Via mpesa steps</h4>
      <ul>
      <li>1. Go to m-pesa menu, select, "lipa na m-pesa"</li>
      <li>2. Select paybill.</li>
      <li>3. Select "enter business number" or paybill number <span style="color:red"><b> 979306</b></span> and then press "ok"</li>
      <li>4. Select "enter account number" which is the reference number <span style="color:red"><b> <?php  if($invoices){
               echo  $invoices['ref_no'];
           }  else {
            echo 'No Reference Number';   
           } ?></b></span> in the above invoice and press "ok"</li>
      <li>5. Enter amount <span style="color:red"><b> Kshs <?php  echo  $mpesapay ;?></b></span></li>
      <li>6. Enter your mpesa pin and press ok</li>
      </ul>       
                        
                                </div>
                            </div>
                            <div role="tabpanel" id="tab-3" class="tab-pane">
                                <div class="panel-body">

                                    <strong>PAY VIA MPESA</strong><br>
                                    <form name="subscribe" method="post" action="pay">
                                             <input type="hidden" name="<?= Yii::$app->request->csrfParam;?>" value="<?= Yii::$app->request->csrfToken;?>">
				
                                            <div class="form-group mb-0" style="color:white">
                                                <input style="background-color: black"type="phone" class="form-control" id="name" name="phone" placeholder="Phone number" required>
						</div>
                                          
                                               <div class="row">
                                   
                                 <div class="col-md-4 col-sm-3 col-xs-4 pl-0">
						<button type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg pull-left">Make payment</button><!-- Send Button -->
					</div>
                                         </form>
                                   
                                </div>
                            </div>
                                </div>
                            <div role="tabpanel" id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                        <div  style="display: block; margin-left: auto;margin-right: auto;width: 50%;">
<div id="paypal-button-container">
    
    
    </div>
    
    </div>
                            </div>
                        </div>


                    </div>
                </div>
<?php
$paydollars=$sum["total"];
$refno=$invoices['ref_no'];

?>

		</div>
	</div>

</div>
<?php
$js = <<<JS
        
$( document ).ready(function() {
    
    
     paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
      
        purchase_units: [{
        
          amount: {
            value: '$paydollars',
            currency: 'USD'
          },
         reference_id: '$refno',
         description: 'SMART HR APPLICATION FEES PAYMENT',
         payee: {
          email: 'pm@gmail.com'
          },
         invoice_number: '$refno',
        
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed Successfully');
        // Call your server to save the transaction
        return fetch('validate', {
          method: 'post',
          headers: {
            'content-type': 'application/json'
          },
          body: JSON.stringify({
            orderID: data.orderID
          })
        });
      });
    }
  }).render('#paypal-button-container');
  
});
        
        
JS;
 
$this->registerJs($js);

    