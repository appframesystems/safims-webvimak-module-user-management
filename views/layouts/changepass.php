<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use frontend\modules\rbac\models\Authitem;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/FIDA.png" type="image/x-icon" />
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>
<!DOCTYPE html>
<!-- this application uses inspinia theme
 installed by kanyatta peter 11/29/2017-->

<body class="">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                           <?= Html::img('@web/inspiniaassests/img/nmb.png', ['alt'=>'FIDA KENYA', 'class'=>'img-circle']);?>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                                        <?php
                    if (Yii::$app->getUser()->identity) {
                        echo Yii::$app->getUser()->identity->fullnames;
                       
                    } else {
                        Yii::$app->response->redirect(['/user-management/auth/logout']);
                    }
                    ?>
                                        
                            </strong>
                             </span> <span class="text-muted text-xs block">
                                 <?PHP
//                                  if (Yii::$app->getUser()->identity) {
//                                      (\Yii::$app->authManager->getRolesByUser(Yii::$app->getUser()->identity->ID));
//                       
//                                  }
                                ?>
                                 
                                 <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div style="color: #f26f21;" class="logo-element">
                        SMART HR
                    </div>
                </li>
                
             
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            
                    <!--if user is loggedin get all open cases-->
                   
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span style="color: #f26f21;" class="m-r-sm text-muted welcome-message">Welcome to  SMART HR</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-briefcase"></i>  <span class="label label-warning"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                
                        
                     
                        <li>
                            <a href="#">
                            <div class="dropdown-messages-box">
<!--                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>-->
                                <div class="media-body">
                                  
                                </div>
                            </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                     
                        <li>
                            <div class="text-center link-block">
                                <a href="#">
                                    <i class="fa fa-envelope"></i> <strong>View all Cases</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                       
                        <li>
                         
                        <li>
                            <div class="text-center link-block">
                                <a href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['/user-management/auth/logout'])?>"
                         >
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <!--navigation breadrumbs-->
            
            </div>

            <div class="wrapper wrapper-content">
                <!--dynamic content will come here-->
                        <?= $content ?>

             
            </div>
<!--            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>-->

        </div>
        </div>
                      
    <?php
 

yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    //'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/esbportal/712.gif'></div></div>";

yii\bootstrap\Modal::end();

?> 
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
        $(document).ready(function() {
            
          //$("body").addClass("md-skin  fixed-sidebar ");
            
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('MANAGEMENT SYSTEM', 'SMART HR');

            }, 1300);


           

           // $('.footable').footable();
           // $('.footable2').footable();

       


            //var ctx4 = document.getElementById("doughnutChart").getContext("2d");
           // new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

         

           // var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
           // new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
    </script>