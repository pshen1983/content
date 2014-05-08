<?php
class LookupImageProjectPathDao extends LookupImageProjectPathDaoParent {

// =============================================== public function =================================================

	public static function getImageIds($projectId, $projectPathId) {
		$lookup = new LookupImageProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('image_id')
						->where('project_id', $projectId)
						->where('project_path_id', $projectPathId)
						->findList();
		if ($rows) {
			$atReturn = array();
			foreach ($rows as $row) {
				array_push($atReturn, $row['image_id']);
			}
			return $atReturn;
		} else {
			return array();
		}
	}

	public static function getImageIdsAndCodes($projectId, $projectPathId) {
		$lookup = new LookupImageProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('image_id, code')
						->where('project_id', $projectId)
						->where('project_path_id', $projectPathId)
						->findList();
		if ($rows) {
			$atReturn = array();
			foreach ($rows as $row) {
				array_push($atReturn, $row);
			}
			return $atReturn;
		} else {
			return array();
		}
	}

	public static function getProjectPaths($projectId, $imageId) {
		$lookup = new LookupImageProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('project_path_id')
						->where('project_id', $projectId)
						->where('image_id', $imageId)
						->findList();
		if ($rows) {
			$atReturn = array();
			foreach ($rows as $row) {
				array_push($atReturn, $row['project_path_id']);
			}
			return $atReturn;
		} else {
			return array();
		}
	}

	public static function removeLookup($projectId, $projectPathId, $imageId) {
		$lookup = new LookupImageProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		return $builder->delete()
					   ->where('project_id', $projectId)
					   ->where('image_id', $imageId)
					   ->where('project_path_id', $projectPathId)
					   ->query();
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getProjectId();
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$sequence = $this->getProjectId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>