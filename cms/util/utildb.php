<?php
final class PdoClone extends PDO {
	public final function __clone() {
		throw new RuntimeException('Clone is not allowed against '.get_class($this));
	}
}

/**
 * DBクラス
 *
 * DBの接続、解除、トランザクションを提供します
 *
 * @author learnchi
 * @version 1.0
 */
class UtilDb {
	/**
	 * インスタンス
	 */
	private static $instance;

	/**
	 * コンストラクタ
	 */
	private function __construct() {
		$ini = parse_ini_file(dirname(__FILE__)."/dbconfig.ini");
		try {
			self::$instance = new PdoClone("mysql:host=".$ini['dbhost']."; dbname=".$ini['dbname'], $ini['dbuser'], $ini['dbpass']);
			self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// 文字コード対応
			self::$instance->query("SET NAMES utf8;");
		} catch(PDOException $e) {
			throw $e;
		}
	}

	/**
	 * DB接続
	 *
	 * @return object DB接続のインスタンス
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
			new self();
		} else {
			//インスタンス化済
		}
		return self::$instance;
	}

	/**
	 * DB接続解除
	 */
	public static function close() {
		self::$instance = null;
	}

	/**
	 * トランザクション開始
	 *
	 * @return boolean true：成功  false：失敗
	 */
	public static function begin() {
		return self::$instance->beginTransaction();
	}

	/**
	 * コミット
	 *
	 * @return boolean true：成功  false：失敗
	 */
	public static function commit() {
		return self::$instance->commit();
	}

	/**
	 * ロールバック
	 *
	 * @return boolean true：成功  false：失敗
	 */
	public static function rollback() {
		return self::$instance->rollBack();
	}
}
?>
