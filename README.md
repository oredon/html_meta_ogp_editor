HTML META OGP Editor
=======

php tool to replace title, keyword, descriptions of html files


notice 注意書き
=======

※ローカルサーバ上で使用してください。パブリックなWEBサーバ等には置かないでください

Please use in local server. NOT USE PUBLIC WEB SERVER.

※このスクリプトを使ったことで生じたいかなる損害やトラブルの責任は一切負いかねますので予めご了承ください。

AT YOUR OWN RISK. I shall not be responsible for any loss, damages and troubles.



概要
=======

・titleやキーワード、OGPを探査し、HTML上にリスト表示します。メタチェックOGPチェックをエディタで一枚一枚開いて閉じて・・・を繰り返さなくてよくなります

・更に閲覧中に誤りを発見した場合、その場で編集し、訂正が可能です

・上記、ファイルを直接書き換える機能を使用する場合はgitなどで巻き戻せるような状態（バックアップ）で試行してください


導入
=======

・ローカルサーバの適当なドキュメントルートにmetaをディレクトリ毎コピー

例）d:\works\XXX\htdocs\_meta\

・PHPの設定は適当に調べてください

・ブラウザで上記にアクセス

例）http://localXXX/_meta

・探査したいディレクトリを入力

例）D:\works\xxx\htdocs

・URLトップを入力

例）http://localXXX/


トラブルシューティングなど
=======

■HTMLファイルが軒並み文字化けした

・HTMLファイルの文字コードを指定するオプションがあります。適宜HTML側の文字コードにあせてください

・バックアップは必ずとってください

繰り返しになりますが・・・

必ずローカルサーバのみで使用してください。公開されているサーバで使うと悪意あるユーザに改ざんされたり、意図しないiframeやscriptコードの埋め込みによるハッキングや踏み台にされてしまう等、悪事の片棒を担がされたりする危険性があります。くれぐれも利用は慎重にお願いします。MITで公開していますので私は一切責任を負いません。自己責任で運用してください。