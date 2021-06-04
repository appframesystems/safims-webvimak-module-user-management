<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5 style="margine-right:10px;">Suppliers</h5>  
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
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="data">
             <thead>
                    <tr>
                    
                       <th>Client Name</th>
                       <th>Supplier Name</th>
                       <th>Created Date</th>
                       <th>Last Loggedin</th>
                        <th>Profile Picture</th>
                       <th>Action</th>
                     
                       
                   
                  </tr>
                    </thead>
                    <tbody>
               <?php foreach ($model as $model){?>
                <tr class="gradeX">
                   
                        <td><?= $model['username'] ?></td>
                        <?php
                    $modelsupplier= new frontend\models\Supplier(); 
                     $supplier=$modelsupplier->find()->where(['id'=>$model['supplier_id']])->one();
                     if($supplier){
                      $suppliername=$supplier['name'];   
                     }else{
                     $suppliername=null;    
                     }
                        
                        ?>
                        <td><?= $suppliername ?></td>
                        <td><?= $model['created_at'] ?></td>
                        <td><?= $model['lastloggedin'] ?></td>
                        
                        <td><?= $model['profilepic'] ?></td>
                       
                        <td>  
                      <?= Html::a('Edit/Update', ['update','id'=>$model['id']], ['class'=>'btn btn-primary btn-xs']) ?> 
                        </td>
                       
                        
                       
                  
                </tr>
               <?php }?>
                    </tbody>      
        </table>
    </div>
</div>
</div>
</div>
        </div>
</div>
</div>
<?php
 $script = <<< JS
   $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });         
JS;
$this->registerJs($script);
?> 

