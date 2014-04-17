<?php
class CreateImageController extends ViewController {

	protected function control() {
		$projectId = param('project_id');

		global $_CSESSION;
		$project = new Project($projectId);

		if ($project->isAvailableToUser($_CSESSION->getUserId())) {
			$code = param('code');

			$project->addImage($code);
		}

		$this->redirect('/project/detail?id='.$projectId);

//		$this->response(array());
	}
}
?>