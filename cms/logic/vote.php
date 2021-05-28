<?php
header("Content-Type: application/json; charset=UTF-8");

require_once(dirname(__FILE__)."/../dblogic/votelogic.php");

/**
 * 投票
 *
 * 実行方法
 * $.post("cms/logic/vote.php",
 * 	{ theme: theme, candidate: candidate },
 * 	function(data){
 * 		alert("Data Loaded: " + JSON.stringify(data));
 * 	},
 * 	"json"
 * );
 *
 * @author learnchi
 */

// 引数の取得
$theme = filter_input(INPUT_POST,"theme");
$candidate = filter_input(INPUT_POST,"candidate");
$voter = $_SERVER["REMOTE_ADDR"];

// logicクラス
$voteLogic = new VoteLogic();

// 一票を投じる
$ins = $voteLogic->insertVote($theme, $candidate, $voter);

// 得票数を取得する
$cnt = $voteLogic->selectVoteCount($theme, $candidate);

unset($voteLogic);
echo json_encode(array("cnt"=>$cnt));
