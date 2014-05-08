<?php
class LookupTextProjectPathDao extends LookupTextProjectPathDaoParent {

// =============================================== public function =================================================

	public static function getTextIds($projectId, $projectPathId) {
		$lookup = new LookupTextProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('text_id')
						->where('project_id', $projectId)
						->where('project_path_id', $projectPathId)
						->findList();
		if ($rows) {
			$atReturn = array();
			foreach ($rows as $row) {
				array_push($atReturn, $row['text_id']);
			}
			return $atReturn;
		} else {
			return array();
		}
	}

	public static function getTextIdsAndCodes($projectId, $projectPathId) {
		$lookup = new LookupTextProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('text_id, code')
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

	public static function getProjectPaths($projectId, $textId) {
		$lookup = new LookupTextProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('project_path_id')
						->where('project_id', $projectId)
						->where('text_id', $textId)
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

	public static function removeLookup($projectId, $projectPathId, $textId) {
		$lookup = new LookupTextProjectPathDao();
		$sequence = $projectId;
		$lookup->setServerAddress($sequence);

		$builder = new QueryBuilder($lookup);
		return $builder->delete()
					   ->where('project_id', $projectId)
					   ->where('text_id', $textId)
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