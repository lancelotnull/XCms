<?php
/**
 * @name getMyGroupsAction.php UTF-8
 * @author ChenJunAn<lancelot1215@gmail.com>
 * 
 * Date 2013-10-1
 * Encoding UTF-8
 */
class getMyGroupsAction extends CmsAction{
	public function run($resourceId){
		$loginedId = $this->app->getUser()->getId();
		if ( $loginedId !== $resourceId ){
			$this->response(402);
		}
		
		$type = $this->getQuery('type',null);
		if ( $type === null ){
			$this->response(201);
		}
		$t = $type == 1 ? 0 : 100;
		
		$groupManager = $this->getController()->getModule()->getGroupManager();
		$list = $groupManager->findMasteredGroups($loginedId,$t);
		
		$response = array();
		foreach ( $list as $l ){
			$response[] = array(
					'id' => $l->getPrimaryKey(),
					'name' => $l->group_name,
					'description' => $l->description,
					'userNum' => $l->user_num
			);
		}
		$this->response(300,'',$response);
	}
}