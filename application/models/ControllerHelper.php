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

	public function createNextList($next) {
		$linkBuilder = new Model_WhatsNextLinkBuilder();

		foreach ($next as $key => $result) {
			if ($result['type'] !== null) {
				$next[$key]['link'] 	= $linkBuilder->getLink($result);	
				$next[$key]['postfix'] 	= $result['result'] . '%  richtig!'; 
				$date 					= new Zend_Date($result['date']);
				$next[$key]['tooltip'] 	= Model_Text::get($result['type'])
											. "\n Zuletzt gespielt am "
											. $date->toString('dd.MM.yyyy');
			} else {
				$next[$key]['linkMC'] 	= $linkBuilder->getGameLink($result['gameid'], 'MC');	
				$next[$key]['linkTXT'] 	= $linkBuilder->getGameLink($result['gameid'], 'TXT');	
				$next[$key]['postfix'] 	= 'neu!'; 
				$next[$key]['tooltip'] 	= 'Diese Game hast du noch nie gespielt!'; 
			}
		}	
		return $next;
	}

	public function removeDoubleResults($data) {
		$newData 	= $data;
		$length		= count($data);
		for ($i = 0; $i < $length; $i++) {
			$j = $i + 1;
			$result = $data[$i];
			for ($j; $j < $length; $j++) {
				$resultToCompare = $data[$j];	
				if ($result['gameid'] === $resultToCompare['gameid']) {
					unset($newData[$j]);
				}
			}
		}
		return $newData;
	}
}
