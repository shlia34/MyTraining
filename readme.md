## 概要
筋トレの記録

## ER図
<img src="https://i.imgur.com/XXn7pus.png" height=600px>

## 使ったライブラリとか

- fullcalendar(トップページのカレンダー表示)
- vuedraggable(ドラッグアンドドロップ)

## その他備考とか
- メールアドレス => "sample@sample" パスワード=>"password" でseederにて作成したユーザーでログインできる
- ローカルはmysqlなんですが、デプロイはherokuのpostgresで使ってます(クレジット登録しないとmysql使えない)。

## セットアップ
なんかいろいろしてからの
- php artisan migrate:refresh --seed

## インストールしたもの
- npm install --save @fullcalendar/vue @fullcalendar/core @fullcalendar/daygrid @fullcalendar/interaction
- npm i -S vuedraggable