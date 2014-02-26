<?php 
class ApplicationBehavior extends CBehavior
{
    public function events()
    {
        return array(
           'onBeginRequest'=>'allotAuthTimeout',
        );
    }

    public function allotAuthTimeout()
    {   
	//$owner = Yii::app()->session['user'];
    $owner=$this->owner;
        $user=$owner->user;
		/*  
        if(!$user->isGuest)
        { 
            if($user->id=="admin") //HERE I HAVE ARBITRARILY ASSIGNED authTimeout.
                $user->authTimeout=10; //YOU HAVE TO APPLY YOUR OWN LOGIC.
            if(!$user->id=="seenivasan")//YOU CAN PARSE authTimeout FROM COOKIES AND ASSIGN IT HERE. */
                $user->authTimeout=5;
            
            $expires=$user->getState(CWebUser::AUTH_TIMEOUT_VAR);
    /*                     
            if ($expires!==null && $expires < time())
                 $user->logout(false);
            else
                 $user->setState(CWebUser::AUTH_TIMEOUT_VAR,time()+$user->authTimeout);
                
        } */
    }
}
?>