<?php

/**
 * Helper for Controllers 
 *
 * @package models
 */
class Model_ControllerHelper {

	public function createGameList($gameList, $userId) {
		foreach ($gameList as $key => $game) {
			$gameListDb = new Model_DbTable_GameList();
			$gameResultDb = new Model_DbTable_GameResult();
            $gameList[$key]['numberOfQuestions'] =
                $gameListDb->countQuestionIds($game['gameid']);
            $existResult = ($userId !== null) ? $gameResultDb->existResultForGameAndUser($game['gameid'], $userId) 
                : false;
            $gameList[$key]['existResult'] = $existResult;

			if ($userId !== null && $existResult !== false) {
				$gameResultDb = new Model_DbTable_GameResult();
				$lastResult = $gameResultDb->
					getResultForGameAndUser($game['gameid'], $userId);
				$gameList[$key]['lastResult'] = $lastResult[0];
			}

            $categoryDb = new Model_DbTable_GameCategoryRelation();
            $gameList[$key]['cat'] = $categoryDb->getCategories($game['gameid']);;
        }
		return $gameList;
	}
}
