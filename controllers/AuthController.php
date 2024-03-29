<?php

namespace webvimark\modules\UserManagement\controllers;

use webvimark\components\BaseController;
use webvimark\modules\UserManagement\components\UserAuthEvent;
use webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm;
use webvimark\modules\UserManagement\models\forms\ConfirmEmailForm;
use webvimark\modules\UserManagement\models\forms\LoginForm;
use webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;

use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\db\Query;


class AuthController extends BaseController
{
    
	/**
	 * @var array
	 */
	//public $freeAccessActions = ['login', 'logout', 'confirm-registration-EMAIL','change-own-password','resetuserpasswords','actualresetpassword'];

      public $freeAccessActions = ['login', 'logout','switchaccount', 'confirm-registration-EMAIL','change-own-password','resetuserpasswords','actualresetpassword'];
	/**
	 * @return array
	 */
	public function actions()
	{
		return [
			'captcha' => $this->module->captchaOptions,
		];
	}
        
        
        
        

	/**
	 * Login form
	 *
	 * @return string
	 */
         public function actionPayment($id)
    {
             $_SESSION["data"] =$id;
               return $this->render('payment', [
                'id' => $id,
             
             
            ]);
    }
     public function actionValidate(){
        
          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
  
           $resp=["ResultDesc"=>"Validation Service request accepted succesfully","ResultCode"=>"0"];
            //read incoming request
            $postData=file_get_contents('php://input');
            
          $jdata=json_decode($postData,true);
          
        $model= new \frontend\models\Mpesapayments();
        
        $model->validatetransaction($jdata['orderID']);
        
        
        
    }
        public function actionPayment2($id)
    {
            $this->layout = 'changepass';
            $_SESSION["id"] =$id;
               return $this->render('payment2', [
                'id' => $id,
             
             
            ]);
    }
          public function actionPayment3($id)
    {
            
               return $this->render('payment3', [
                'id' => $id,
             
             
            ]);
    }

 public function actionSwitchaccount(){
      $code=Yii::$app->request->post('id'); 
      $model = new LoginForm();
      $username=Yii::$app->getUser()->identity->username;
         $connection = \Yii::$app->db1;

                    $connection = \Yii::$app->db1;
                 
                    $users = $connection
                    ->createCommand('SELECT * FROM clients where code=:code')
                    ->bindValues([':code' =>$code])
                    ->queryOne();
                   
                   
                    if($users){
                  
                    //set sessions for client db
                    //register connection info in session, these info are retrived before application run
                   $dns='mysql:host='.$users['host'].';dbname='.$users['dbname'];
                  // ($dns);  exit;
                   Yii::$app->session->set('custorem_connection.dns', $dns);
                   Yii::$app->session->set('custorem_connection.username', $users['dbuser']);
                   Yii::$app->session->set('custorem_connection.password', $users['dbpassword']);
        
                   
                    }
                    else{
                   
                        //client does not exit
                       Yii::$app->session->set('companystatus', 1);
                        return  $this->redirect(array('login'));
                    }   
                 
                    
                    $model->username=$username;
               
                    if($model->login()){
                    
                    $USERMODEL= new \frontend\models\User();
                     $user=$USERMODEL->find()->where(['id'=>Yii::$app->getUser()->identity->id])->one();
                     $user->loggedin=1;
                  
                   $settings=90;
                    $user->passexpirydate=date('Y-m-d', strtotime("+$settings days"));
                      $user->lastloggedin=date('Y-m-d H:i:s');
                     
                     $user->update(false);
                     
                    if(Yii::$app->getUser()->identity->firstlogin==1){

                      return $this->redirect(['change-own-password']);   
                        
                      }
         
                        $curdate=strtotime(date('Y-m-d'));
                        $mydate=strtotime(Yii::$app->getUser()->identity->passexpirydate);
                        if($curdate>=$mydate){
                        Yii::$app->session->setFlash('error', 'Your Password Have Exired.Please Changed It.');
                         return $this->redirect(['/user-management/auth/change-own-password']);   
                        }
                        else{
                           echo 4;  exit;
 
                          if($user->supplier==1){  
                         return  $this->redirect(array('/site/index2'));
                          }else{
                          return  $this->redirect(array('/site/index1'));    
                          } 
                        }
                        }
                         Yii::$app->session->setFlash('success', 'Account switched successfully.');
                        
			return $this->goBack();
      
   
     
 }
public function actionLogin()
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$model = new LoginForm();

		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
                  
		if ( $model->load(Yii::$app->request->post()))
		{
                    $connection = \Yii::$app->db1;
                    $username=$model->username;
                    $user= $connection
                    ->createCommand('SELECT * FROM user where username=:username')
                    ->bindValues([':username' =>$username])
                    ->queryOne();
                    if($user){
                        $code=$user['branch'];
                    }else{
                    $code=Null;
                    }
                    
                 
                    $connection = \Yii::$app->db1;
                    $users = $connection
                    ->createCommand('SELECT * FROM clients where code=:code')
                    ->bindValues([':code' =>$code])
                    ->queryOne();
               
                    if($users){
                    
                    //set sessions for client db
                    //register connection info in session, these info are retrived before application run
                   $dns='mysql:host='.$users['host'].';dbname='.$users['dbname'];
                  // ($dns);  exit;
                   Yii::$app->session->set('custorem_connection.dns', $dns);
                   Yii::$app->session->set('custorem_connection.username', $users['dbuser']);
                   Yii::$app->session->set('custorem_connection.password', $users['dbpassword']);

                    }
                    else{
                     
                        
                         Yii::$app->session->setFlash('error', 'User Credentials Invalid');  
                        return  $this->redirect(array('login'));
                    }  
                    if($model->login()){
                    $USERMODEL= new \frontend\models\User();
                     $user=$USERMODEL->find()->where(['id'=>Yii::$app->getUser()->identity->id])->one();
                     $user->loggedin=1;
                     $user->active_status=1;
                     $settings=90;
                     $user->passexpirydate=date('Y-m-d', strtotime("+$settings days"));
                     $user->lastloggedin=date('Y-m-d H:i:s');
                     
                     $user->update(false);
                    //check if first time login
                    
                    if(Yii::$app->getUser()->identity->firstlogin==1){
                     
                      return $this->redirect(['change-own-password']);   
                        
                      }

                      //  check if user password have expired
                        $curdate=strtotime(date('Y-m-d'));
                        $mydate=strtotime(Yii::$app->getUser()->identity->passexpirydate);
                        if($curdate>=$mydate){
                        Yii::$app->session->setFlash('error', 'Your Password Have Exired.Please Changed It.');
                         return $this->redirect(['/user-management/auth/change-own-password']);   
                        }
                        else{

                           if($user->user_type==2){  
                         
                         return  $this->redirect(array('/site/client'));
                          }
                          if($user->supplier==1){  
                         
                         return  $this->redirect(array('/site/index2'));
                         
                          }else{
                         
                          return  $this->redirect(array('/site/index1'));    
                          } 
                         
                        }
                       }else{
						Yii::$app->session->setFlash('error', 'User Credentials Invalid');  
                        return  $this->redirect(array('login'));
					   }
			return $this->goBack();
		}

		return $this->renderIsAjax('login', compact('model'));
	}
	/**
	 * Logout and redirect to home page
	 */
public function actionLogout()
	{
         
             $usermodel= new \frontend\models\User();
                  $user=$usermodel->find()->where(['id'=>Yii::$app->getUser()->identity->id])->one();
                  if($user){
                      $user->active_status=0;
                      $user->save(FALSE);
                  }
		Yii::$app->user->logout();

		return $this->redirect(Yii::$app->homeUrl);
	}
        
         /**
         * 
         * 
         * force logout
         */
        
          public function actionForcelogout(){
            
            $model= new \frontend\modules\document\models\User();
            $user= $model->find()->where(['loggedin'=>1])->all();
            
            return $this->render('forcelogout', [
                'model' => $user,
            ]);
        }
        
        
        //actual force logout
        public function actionActualforcelogout($id){
           
            $model= new User();
            
            $model= $model->find()->where(['id'=>$id])->one();
          
            $model->loggedin=0;
            if($model->save(false)){
                 Yii::$app->session->setFlash('success', 'User logged out Successfully.');
                  return $this->redirect(['forcelogout']);  
            }
            else{
                Yii::$app->session->setFlash('error', 'User failed to be logged out.');
                  return $this->redirect(['forcelogout']);   
            }
        }
        
        
        

	/**
	 * Change your own password
	 *
	 * @throws \yii\web\ForbiddenHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionChangeOwnPassword()
	{
		if ( Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$user = User::getCurrentUser();

		if ( $user->status != User::STATUS_ACTIVE )
		{
			throw new ForbiddenHttpException();
		}

		$model = new ChangeOwnPasswordForm(['user'=>$user]);


		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->changePassword() )
		{
                 $sql='UPDATE user SET password_hash="'.$user->password_hash.'" WHERE username="'.$user->username.'"';
                 \Yii::$app->db1->createCommand($sql)->execute();
                          if($user->user_type==2){  
                         return  $this->redirect(array('/site/client'));
                          }
                          elseif($user->supplier==1){  
                         return  $this->redirect(array('/site/index2'));
                          }else{
                          return  $this->redirect(array('/site/index1'));    
                          } 
			
		}
               

		return $this->renderIsAjax('changeOwnPassword', compact('model'));
	}

	/**
	 * Registration logic
	 *
	 * @return string
	 */
	public function actionRegistration()
	{
		

		$model = new $this->module->registrationFormClass;


		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{

			Yii::$app->response->format = Response::FORMAT_JSON;

			// Ajax validation breaks captcha. See https://github.com/yiisoft/yii2/issues/6115
			// Thanks to TomskDiver
			$validateAttributes = $model->attributes;
			unset($validateAttributes['captcha']);

			return ActiveForm::validate($model, $validateAttributes);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
		{
			// Trigger event "before registration" and checks if it's valid
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_REGISTRATION, ['model'=>$model]) )
			{
				$user = $model->registerUser(false);

				// Trigger event "after registration" and checks if it's valid
				if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_REGISTRATION, ['model'=>$model, 'user'=>$user]) )
				{
					if ( $user )
					{
						if ( Yii::$app->getModule('user-management')->useEmailAsLogin AND Yii::$app->getModule('user-management')->emailConfirmationRequired )
						{
							return $this->renderIsAjax('registrationWaitForEmailConfirmation', compact('user'));
						}
						else
						{
							$roles = (array)$this->module->rolesAfterRegistration;

							foreach ($roles as $role)
							{
								User::assignRole($user->id, $role);
							}

							Yii::$app->user->login($user);

							return $this->redirect(Yii::$app->user->returnUrl);
						}

					}
				}
			}

		}

		return $this->renderIsAjax('registration', compact('model'));
	}


	/**
	 * Receive token after registration, find user by it and confirm email
	 *
	 * @param string $token
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionConfirmRegistrationEmail($token)
	{
		if ( Yii::$app->getModule('user-management')->useEmailAsLogin AND Yii::$app->getModule('user-management')->emailConfirmationRequired )
		{
			$model = new $this->module->registrationFormClass;

			$user = $model->checkConfirmationToken($token);

			if ( $user )
			{
				return $this->renderIsAjax('confirmEmailSuccess', compact('user'));
			}

			throw new NotFoundHttpException(UserManagementModule::t('front', 'Token not found. It may be expired'));
		}
	}


	/**
	 * Form to recover password
	 *
	 * @return string|\yii\web\Response
	 */
	public function actionPasswordRecovery()
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$model = new PasswordRecoveryForm();

		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;

			// Ajax validation breaks captcha. See https://github.com/yiisoft/yii2/issues/6115
			// Thanks to TomskDiver
			$validateAttributes = $model->attributes;
			unset($validateAttributes['captcha']);

			return ActiveForm::validate($model, $validateAttributes);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
		{
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_PASSWORD_RECOVERY_REQUEST, ['model'=>$model]) )
			{
				if ( $model->sendEmail(false) )
				{
					if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_PASSWORD_RECOVERY_REQUEST, ['model'=>$model]) )
					{
						return $this->renderIsAjax('passwordRecoverySuccess');
					}
				}
				else
				{
					Yii::$app->session->setFlash('error', UserManagementModule::t('front', "Unable to send message for email provided"));
				}
			}
		}

		return $this->renderIsAjax('passwordRecovery', compact('model'));
	}

	/**
	 * Receive token, find user by it and show form to change password
	 *
	 * @param string $token
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionPasswordRecoveryReceive($token)
	{
		if ( !Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$user = User::findByConfirmationToken($token);

		if ( !$user )
		{
			throw new NotFoundHttpException(UserManagementModule::t('front', 'Token not found. It may be expired. Try reset password once more'));
		}

		$model = new ChangeOwnPasswordForm([
			'scenario'=>'restoreViaEmail',
			'user'=>$user,
		]);

		if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
		{
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_PASSWORD_RECOVERY_COMPLETE, ['model'=>$model]) )
			{
				$model->changePassword(false);

				if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_PASSWORD_RECOVERY_COMPLETE, ['model'=>$model]) )
				{
					return $this->renderIsAjax('changeOwnPasswordSuccess');
				}
			}
		}

		return $this->renderIsAjax('changeOwnPassword', compact('model'));
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionConfirmEmail()
	{
		if ( Yii::$app->user->isGuest )
		{
			return $this->goHome();
		}

		$user = User::getCurrentUser();

		if ( $user->email_confirmed == 1 )
		{
			return $this->renderIsAjax('confirmEmailSuccess', compact('user'));
		}

		$model = new ConfirmEmailForm([
			'email'=>$user->email,
			'user'=>$user,
		]);

		if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
		{
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}

		if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
		{
			if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_EMAIL_CONFIRMATION_REQUEST, ['model'=>$model]) )
			{
				if ( $model->sendEmail(false) )
				{
					if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_EMAIL_CONFIRMATION_REQUEST, ['model'=>$model]) )
					{
						return $this->refresh();
					}
				}
				else
				{
					Yii::$app->session->setFlash('error', UserManagementModule::t('front', "Unable to send message for email provided"));
				}
			}
		}

		return $this->renderIsAjax('confirmEmail', compact('model'));
	}

	/**
	 * Receive token, find user by it and confirm email
	 *
	 * @param string $token
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string|\yii\web\Response
	 */
	public function actionConfirmEmailReceive($token)
	{
		$user = User::findByConfirmationToken($token);

		if ( !$user )
		{
			throw new NotFoundHttpException(UserManagementModule::t('front', 'Token not found. It may be expired'));
		}
		
		$user->email_confirmed = 1;
		$user->removeConfirmationToken();
		$user->save(false);

		return $this->renderIsAjax('confirmEmailSuccess', compact('user'));
	}

	/**
	 * Universal method for triggering events like "before registration", "after registration" and so on
	 *
	 * @param string $eventName
	 * @param array  $data
	 *
	 * @return bool
	 */

    
        protected function triggerModuleEvent($eventName, $data = [])
	{
		$event = new UserAuthEvent($data);

		$this->module->trigger($eventName, $event);

		return $event->isValid;
	}
}
