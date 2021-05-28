<?php
require_once(dirname(__FILE__)."/sqlconst.php");
require_once(dirname(__FILE__)."/../util/utildb.php");

/**
 * DBロジッククラス（候補テーブル candidate）
 *
 * @author learnchi
 * @version 1.0
 */
class CandidateLogic {

	/**
	 * 候補,投票テーブルを検索します（テーマごとに取得、得票数も）
	 *
	 * @param int $theme_id テーマ番号
	 * @return array 検索結果配列
	 */
	public function selectCandidateThemeWithVote($theme_id) {

		$rtn = -1;

		try {
			// DB接続
			$pdb = UtilDb::getInstance();

			$sql = SqlConst::SQL_CV_01;
			$stmt = $pdb->prepare($sql);
			$stmt->bindValue(1, $theme_id, PDO::PARAM_INT);
			$stmt->bindValue(2, $theme_id, PDO::PARAM_INT);

			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				$rtn = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}

			// DB接続解除
			UtilDb::close();
		} catch (PDOException $e){

			// DB接続解除
			UtilDb::close();
		}

		return $rtn;
	}
	/**
	 * 候補,投票テーブルを検索します（テーマごとに取得、得票がある候補のみ）
	 *
	 * @param int $theme_id テーマ番号
	 * @return array 検索結果配列
	 */
	public function selectResult($theme_id) {
		$rtn = -1;

		try {
			// DB接続
			$pdb = UtilDb::getInstance();

			$sql = SqlConst::SQL_CV_02;
			$stmt = $pdb->prepare($sql);
			$stmt->bindValue(1, $theme_id, PDO::PARAM_INT);

			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				$rtn = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}

			// DB接続解除
			UtilDb::close();
		} catch (PDOException $e){

			// DB接続解除
			UtilDb::close();
		}

		return $rtn;
	}

}
