## 概要
筋トレの記録

## ER図
<img src="https://i.imgur.com/XXn7pus.png" height=600px>
これはer.pumlを描画してる

## 使ったライブラリ

- jquery
- jqueryui(トレーニング種目をドラッグアンドドロップで並び替え)
- jqueryui-touch-punch(jqueryuiのタッチイベントをスマホでも動かす)
- fullcalendar(トップページのカレンダー表示)
- remodal(イベント作成とトレーニングを押したときのモーダル)
- Bootstrap(見た目を整えた)

## その他備考とか
- メールアドレス => "sample@sample" パスワード=>"password" でseederにて作成したユーザーでログインできる
- ローカルはmysqlなんですが、デプロイはherokuのpostgresで使ってます(クレジット登録しないとmysql使えない)。
- フロントをvue.jsで書きかえてみたい

## セットアップ
- php artisan migrate:refresh --seed
- npm install --save @fullcalendar/vue @fullcalendar/core @fullcalendar/daygrid @fullcalendar/interaction
