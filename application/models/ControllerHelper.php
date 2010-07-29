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

            $hasCategoryDb = new Model_DbTable_HasCategory();
            $questionIds   = Model_String::explodeString($game['questionids']);
            $categoryIds   = array();
            foreach ($questionIds as $questionId) {
                $currentIds  = $hasCategoryDb->getCategoryIds($questionId);
                $categoryIds = array_merge($categoryIds, $currentIds);
            }
            $categoryIds = (array_unique($categoryIds));
            $categoryDb  = new Model_DbTable_Category();
            $categories  = array();
            foreach ($categoryIds as $categoryId) {
                $categories[] = $categoryDb->getCategory($categoryId);
            }
            $gameList[$key]['cat'] = $categories;
        }
		return $gameList;
	}
}
