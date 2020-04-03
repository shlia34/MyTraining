## 概要

筋トレの記録

## デモ
<img src="https://raw.github.com/wiki/shlia34/workout-logger/image/demo.gif" width="300">

## ER図
<img width="700" alt="スクリーンショット 2020-04-03 14 14 15" src="https://user-images.githubusercontent.com/42834409/78326503-8c347580-75b5-11ea-92ac-dc6cf14f3a49.png">

eventとtrainingの間の一個テーブル挟めば良かったと後悔してます。そのせいでtrainingを表示するときに変なことしてる。
stage_userは各ユーザーの筋トレ種目リストみたいなので、modelではchoiceって名前になってます。

## 使ったライブラリ

- jquery
- jqueryui(トレーニング種目をドラッグアンドドロップで並び替え)
- jqueryui-touch-punch(jqueryuiのタッチイベントをスマホでも動かす)
- fullcalendar(トップページのカレンダー表示)
- remodal(イベント作成とトレーニングを押したときのモーダル)
- Bootstrap(見た目を整えた)

## その他備考とか

- メールアドレス => "sample@sample" パスワード=>"password" でseederにて作成したユーザーでログインできる
- csvは本番のデータ保持したままdb構造途中で変えた時にとりあえず作ったやつ、僕用に作った感じです。
- ローカルはmysqlなんですが、デプロイはherokuのpostgresで使ってます(クレジット登録しないとmysql使えない)。
- pcで見るとだいぶ見た目汚いけど、自分がスマホで使うからこのままでいいやと思ってます。
- データベースもっといい感じに設計？できないかなーと思ってます。
