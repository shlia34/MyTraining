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
- https://github.com/shlia34/workout-logger/commit/9e8bbea3f6f1d9f3d0d4cd5ebd3c83162ad71d80までがvue入れる前。

## セットアップ
なんかいろいろしてからの
- php artisan migrate:refresh --seed

## インストールしたもの
- npm install --save @fullcalendar/vue @fullcalendar/core @fullcalendar/daygrid @fullcalendar/interaction
- npm i -S vuedraggable
- npm install -D vue-router
- npm install -D vuetify
- npm install sass sass-loader fibers deepmerge -D