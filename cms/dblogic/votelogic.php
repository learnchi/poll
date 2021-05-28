<?php
require_once(dirname(__FILE__)."/sqlconst.php");
require_once(dirname(__FILE__)."/../util/utildb.php");

/**
 * DBロジッククラス（投票テーブル vote）
 *
 * @author learnchi
 * @version 1.0
 */
class VoteLogic {
	/**
	 * 投票テーブルを検索して件数を取得します
	 *
	 * @param int $theme_id テーマ番号
	 * @param int $candidate_id 候補番号
	 * @return int 件数
	 */
	public function selectVoteCount($theme_id, $candidate_id) {
		// SQL生成
		$sql = SqlConst::SQL_VT_01.SqlConst::SQL_VT_02;

		$rtn = 0;

		try {
			// DB接続
			$pdb = UtilDb::getInstance();

			$stmt = $pdb->prepare($sql);
			$stmt->bindValue(1, $theme_id, PDO::PARAM_INT);
			$stmt->bindValue(2, $candidate_id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() === 1) {
				$rtncnt = $stmt->fetch();
				$rtn = $rtncnt[0];
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
	 * 投票テーブルを検索して件数を取得します
	 * 候補ごとの得票数のdistinctして集計
	 * 得票数のグラフの100%値になる
	 *
	 * @param int $theme_id テーマ番号
	 * @param int $candidate_id 候補番号
	 * @return int 件数
	 */
	public function selectVoteCountForResul($theme_id) {

		// SQL生成
		$sql = SqlConst::SQL_VT_03;

		$rtn = 0;

		try {
			// DB接続
			$pdb = UtilDb::getInstance();

			$stmt = $pdb->prepare($sql);
			$stmt->bindValue(1, $theme_id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() === 1) {
				$rtncnt = $stmt->fetch();
				$rtn = $rtncnt[0];
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
	 * 投票情報を追加します.
	 *
	 * @param array $key 登録項目配列
	 * @return int 登録theme_id
	 */
	public function insertVote($theme_id, $candidate_id, $voter) {

		$rtnins = -1;

		try {
			// DB接続
			$pdb = UtilDb::getInstance();

			// トランザクション開始
			UtilDb::begin();

			$sql = SqlConst::SQL_VT_04;
			$stmt = $pdb->prepare($sql);

			$stmt->bindValue(1, $theme_id, PDO::PARAM_INT);
			$stmt->bindValue(2, $candidate_id, PDO::PARAM_INT);
			$stmt->bindValue(3, $voter, PDO::PARAM_STR);

			if ($stmt->execute()) {
				// 登録された theme_id
				$rtnins = $pdb->lastInsertId();

				// コミット
				UtilDb::commit();
			} else {
				// ロールバック
				UtilDb::rollback();
			}

			// DB接続解除
			UtilDb::close();
		} catch (PDOException $e){

			// ロールバック
			UtilDb::rollback();

			// DB接続解除
			UtilDb::close();
		}

		return $rtnins;
	}
}
