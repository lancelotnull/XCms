<?php
/**
 * @name joinGroupAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-9-29
 * Encoding UTF-8
 */
class joinGroupAction extends CmsAction{
	public function run($resourceId){
		$loginedId = $this->app->getUser()->getId();
		if ( $loginedId !== $resourceId ){
			$this->response(402);
		}
		
		$groupId = $this->getPost('group',null);
		if ( $groupId === null ){
			$this->response(201);
		}
		
		$groupManager = $this->getController()->getModule()->getGroupManager();
		$result = $groupManager->addMemberToGroup($groupId,$loginedId);
		
		if ( $result === true ){
			$this->response(200);
		}else {
			$this->response(201,'',$result);
		}
	}
}