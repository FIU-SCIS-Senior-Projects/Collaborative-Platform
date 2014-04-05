<?php
class MessageController extends Controller
{
	
	public function actionIndex($target = null)
	{
		$user = User::model()->findByAttributes(array('username'=>Yii::app()->user->name));
				
				
		$this->render('view', array('user'=>$user, 'target'=>$target)); //'deletedMessages'=>$deletedMessages));
	}	
		
	public function actionSend($username = null, $reply=null, $selfReply = null)
	{
		echo Yii::app()->user->name;
		$user = new User;
		$model = new Message;
		$message = null;		
		
		$users = array();
		$models = User::model()->findAll(/*array('condition'=>'isMentee')*/);
		
		foreach($models as $aUser)
		{
			$users[] = array(
					'label'=>$aUser->fname . ' ' . $aUser->lname,
					'value'=>"\"" .$aUser->fname . " ".$aUser->lname."\" <" .$aUser->username . ">"
			);
		}
				 
		if (isset($_POST['Message']))
		{
			$model->attributes = $_POST['Message'];
			
			
				$model->sender = Yii::app()->user->name;
				$model->created_date = date('Y-m-d H:i:s');
				//$model->userImage = $model->sender0->image_url;

				$model->subject = $_POST['Message']['subject'];
				
				$receivers = $this->getReceivers($_POST["receiver"]);
				$receiverCount = count($receivers);
				
				for ($i = 0; $i < $receiverCount; $i++)
				{
					$model->receiver = $receivers[$i];
					if (User::model()->find("username=:username",array(':username'=>$model->receiver)) != null)
						$model->save();	

					$model = new Message;
					$model->attributes = $_POST['Message'];						
					$model->sender = Yii::app()->user->name;
					$model->created_date = date('Y-m-d H:i:s');
					//$model->userImage = $model->sender0->image_url;					
					$model->subject = $_POST['Message']['subject'];
				}

				User::sendUserNotificationMessageAlert(Yii::app()->user->id, $model->receiver, 'http://'.Yii::app()->request->getServerName().'/coplat/index.php/message', 3);
				$link= CHtml::link('click here to see the message', 'http://'.Yii::app()->request->getServerName().'/coplat/index.php/message');
				$recive = User::model()->find("username=:username",array(':username'=>$model->receiver));
				if ($recive != NULL){
                    $message = "You just got a message from '$model->sender'<br/> '$model->message'<br/>$link";
                    $html = User::replaceMessage($recive->username, $message);
                    User::sendEmailMessageNotificationAlert($recive->email, $html);
				}
				$this->redirect("/coplat/index.php/message");
				return;
				
		}
		
		if ($reply != null)
		{
			$message = Message::model()->findByPK($reply);
			
			if (Yii::app()->user->name == $message->sender)
			   $username = $message->receiver;
			else
			   $username = $message->sender;
			
			$model->subject = $message->subject;
			$model->message = "\n\n\nOn " . $message->created_date . ", " . $message->sender . " wrote:\n" . $message->message;
		}	
		
		$this->render('send', array('user'=>$user, 'users'=>$users, 'model'=>$model, 'username'=>$username));		
	}
	
	//Ajax calls
	public function actionGetInbox()
	{
		$username = Yii::app()->user->name;
		$user = User::model()->find("username=:username",array(':username'=>$username));
		$messages = array();
		foreach ($user->messages(array('order'=>'id DESC')) as $aMessage)
		{
			if (!$aMessage->been_deleted)
			   $messages[] = $aMessage;
		}
		
		print CJSON::encode($messages);			
	}
	
	public function actionGetMessage($id)
	{
		$message = Message::model()->findByPK($id);
		print CJSON::encode($message);
	}
	
	public function actionGetSent()
	{
		$username = Yii::app()->user->name;
		$user = User::model()->find("username=:username",array(':username'=>$username));
		$messages = array();
		foreach ($user->messages1(array('order'=>'id DESC')) as $aMessage)
		{
			if (!$aMessage->been_deleted)
				$messages[] = $aMessage;
		}
		
		print CJSON::encode($messages);
	}
	
	public function actionGetTrash()
	{
		$username = Yii::app()->user->name;
		$user = User::model()->find("username=:username",array(':username'=>$username));
		$messages = array();
		foreach ($user->messages1(array('order'=>'id DESC')) as $aMessage)
		{
			if ($aMessage->been_deleted)
				$messages[] = $aMessage;
		}
		
		foreach ($user->messages1(array('order'=>'id DESC')) as $aMessage)
		{
			if ($aMessage->been_deleted)
				$messages[] = $aMessage;
		}
		
		print CJSON::encode($messages);
	}
	
	public function actionSetAsRead($id)
	{
		$message = Message::model()->findByPk($id);
		$message->been_read = true;
		$message->save();
	}
	
	public function actionSentToTrash()
	{
		$ids = $_REQUEST['messages'];
		foreach ($ids as $id)
		{
			$theId = intval($id);
			$message = Message::model()->findByPK($theId);
			$message->been_deleted = true;
			$message->save(false);
		}
	}
	
	public function actionDeleteMessage()
	{
		$ids = $_REQUEST['messages'];
		foreach ($ids as $id)
		{
			$theId = intval($id);
			Message::model()->deleteByPK($theId);			
		}		
	}
	
	public function actionDeleteMessages()
	{
		$ids = $_REQUEST['messages'];
		foreach ($ids as $id)
		{
			$theId = intval($id);
			Message::model()->deleteByPK($theId);
		}
	}
	
	public function actionAutoComplete()
	{
		$users = array();
		
		if (isset($_GET['term'])) {
		
		   $models = User::model()->findAll();
		
		   foreach($models as $aUser)
		   {
			  $users[] = array(
			      'name'=>$aUser->username,
				  'label'=>$aUser->username,
				  'id'=>$aUser->id,
		      );
		   }
		}

		print "<pre>"; print_r($users);print "</pre>";return;
		print CJSON::encode($users);
	}
	
	private function getReceivers($string)
	{
		$receivers = array();
		$startPos = strpos($string, "<");
		while ($startPos !== false)
		{
			$endPos = strpos($string, ">");
			$receivers[] = substr($string , $startPos + 1, $endPos - $startPos - 1);
			
			$string = substr($string , $endPos + 2);
			
			if($string)
			  $startPos = strpos($string, "<");
			else
			  $startPos = false;
		}
		return $receivers;
	}
	
	
	
	
	//Specifies access rules
	public function accessRules()
	{
		return array(
				array('allow',  // allow authenticated users to perform these actions
						'actions'=>array('Index', 'Send', 'getInbox', 'getMessage', 'getSent',
								'setAsRead', 'sentToTrash', 'getTrash', 'deleteMessage', 'deleteMessages',
								'autoComplete'),
						'users'=>array('@')),
				array('deny', //deny all users anything not specified
						'users'=>array('*'),
						'message'=>'Access Denied.'),
		);
	}
	
	
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
				'accessControl',
		);
	}
}