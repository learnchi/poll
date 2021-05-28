<?php
require_once(dirname(__FILE__)."/sqlconst.php");
require_once(dirname(__FILE__)."/../util/utildb.php");

/**
 * DBロジッククラス（テーマテーブル theme_tbl）
 *
 * @author learnchi
 * @version 1.0
 */
class ThemeLogic {
	/**
	 * テーマテーブルを検索します（1件取得）
	 *
	 * @param int $key theme_id テーマ番号
	 * @return array 検索結果配列
	 */
	public function selectTheme($key) {
		$rtn = -1;

		try {
			// DB接続
			$pdb = UtilDb::getInstance();

			$sql = SqlConst::SQL_TM_01.SqlConst::SQL_TM_02;
			$stmt = $pdb->prepare($sql);
			$stmt->bindValue(1, $key, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				$rtn = $stmt->fetch(PDO::FETCH_ASSOC);
			} else {
				$rtn = -2;
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
	 * テーマテーブルを検索します（一覧取得）
	 *
	 * @param int $disp_kbn 表示区分
	 * @param int $disp_kbn 取得件数
	 * @return array 検索結果配列
	 */
	public function selectThemeList( $page_limit = 100) {

		$rtn = array();

		try {
			// DB接続
			$pdb = UtilDb::getInstance();

			$stmt = $pdb->prepare(SqlConst::SQL_TM_01.SqlConst::SQL_TM_03);
			$stmt->bindValue(1, $page_limit, PDO::PARAM_INT);

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
