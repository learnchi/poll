# poll
ごく単純な投票システムです。
閲覧者は投票ボタンを押すことで投票できます。いくらでも投票できるし、修正削除はできません。
投票のテーマや選択肢を設定する画面もないので、DBに直接書き込んでください。

# 動作環境
Apache/2.4.37 
PHP のバージョン: 7.2.13
DBのバージョン： 10.1.37-MariaDB

# データベースの準備
`/doc/poll_db.sql`を実行してください。

# 投票の設定追加
データベースに以下のように書き込みます。

themeテーブル
- theme_id：　キー項目。見本で1を使用しています。
- theme_name：　タイトル
- theme_explanation：　説明書き
- deadline：　投票締め切り。表示するだけで特にロジックはありません。
- theme_img：　画像

candidateテーブル
- theme_id：　themeテーブルと同一に
- candidate_id：　キー項目
- candidate_name：　選択肢の名前
- candidate_img：　選択肢の画像
- candidate_explanation：　説明書き
