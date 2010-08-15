<?php

/**
 * Helper for Controllers 
 *
 * @package models
 */
class Model_ControllerHelper {

	public function createGameList($gameList, $userId) {
		$gameListDb 	= new Model_DbTable_GameList();
		$gameResultDb 	= new Model_DbTable_GameResult();
        $categoryDb 	= new Model_DbTable_GameCategoryRelation();
		$gameResultDb 	= new Model_DbTable_GameResult();
		foreach ($gameList as $key => $game) {
            $gameList[$key]['numberOfQuestions'] =
                $gameListDb->countQuestionIds($game['gameid']);
            $existResult = ($userId !== null) ? $gameResultDb->existResultForGameAndUser($game['gameid'], $userId) 
                : false;
            $gameList[$key]['existResult'] = $existResult;

			if ($userId !== null && $existResult !== false) {
				$lastResult = $gameResultDb->
					getResultForGameAndUser($game['gameid'], $userId);
				$gameList[$key]['lastResult'] = $lastResult[0];
			}

            $gameList[$key]['cat'] = $categoryDb->getCategories($game['gameid']);;
        }
		return $gameList;
	}
}
