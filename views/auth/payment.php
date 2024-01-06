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
      $locations="SELECT * from invoices where j_id='$id'";
       $db=Yii::$app->db1;
        $command=$db->createCommand($locations);
       $invoices= $command->queryOne(); 
       $sql="SELECT * from jobs where j_id='$id'";
       $db=Yii::$app->db2;
        $command=$db->createCommand($sql);
       $jobname= $command->queryOne();
       $locations="SELECT * from invoices where j_id='$id' AND invoice_status=0 AND type='Recruitment'";
       $db=Yii::$app->db1;
        $command=$db->createCommand($locations);
       $allinvoices= $command->queryAll();
     $SQL="SELECT SUM(amount) AS total FROM invoices where j_id='$id' AND invoice_status=0 AND type='Recruitment'";
       
        $db=Yii::$app->db1;
        $command=$db->createCommand($SQL);
       $sum= $command->queryOne();
      
       
       $locations="SELECT * from jobs where j_id='".$invoices['j_id']."'";
       $db=Yii::$app->db2;
        $command=$db->createCommand($locations);
       $packages= $command->queryOne();
       if($packages){
           $packag=$packages['name'];
       }else{
         $packag=NULL;  
       }
       
      ?>
     <div class="row">
         
         <div class="col-lg-6">
     <h1>Invoice for job post <?= $jobname['name'] ?> </h1>
         </div>
         <div class="col-lg-6"></div>
     </div>
            <div class="row">
                <div class="col-lg-4">
                                           
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
                        <th>Job</th>
                        <th>Amount</th>
                         
                       
                        
                        
                        
                          
                   
                        
                    </tr>
                    </thead>
                    <tbody>
                         <?php foreach($allinvoices as $allinvoices){  ?>
                    <tr>
                        <td><?= $packag ?></td>
                         <td>$ <?= $allinvoices['amount'] ?></td>
                          
                       

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
                <div class="col-md-8">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                             <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> NORMAL MPESA PAYMENT</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-3">MPESA EXPRESS CHECKOUT</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#tab-2">PAYPAL</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" id="tab-1" class="tab-pane active">
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
      <li>5. Enter amount <span style="color:red"><b> Kshs <?php  echo $mpesapay ;?></b></span></li>
      <li>6. Enter your mpesa pin and press ok</li>
      </ul>    
                            </div>
                            </div>
                            <div role="tabpanel" id="tab-3" class="tab-pane">
                                <div class="panel-body">

                                    <strong>PAY VIA MPESA</strong><br>
                                    <form name="subscribe" method="post" action="pay2">
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
                                    <!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/hk/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/hk/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/PP_AcceptanceMarkTray-NoDiscover_243x40.png" alt="Buy now with PayPal" /></a></td></tr></table><!-- PayPal Logo -->  </div>
                            </div>
                        </div>


                    </div>
                </div>


		</div>
	</div>

</div>
