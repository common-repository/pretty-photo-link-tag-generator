=== Plugin Name ===
Contributors: taman777
Donate link: http://blog.gti.jp/
Tags: jquery,prettyPhoto
Requires at least: 3.1
Tested up to: 3.4.2
Stable tag: 0.2

jQueryで動作するprettyPhotoライブラリをWordPress上で簡単に再現出来るようにしたものです。
写真を大きく見せるなどの利用法ではなく、WEBページを表示するために特化していると考えてください。

== Description ==
jQueryで動作するprettyPhotoライブラリをWordPress上で簡単に再現出来るようにしたものです。
写真を大きく見せるなどの利用法ではなく、WEBページを表示するために特化していると考えてください。

jQueryプラグインライブラリ Pretty Photoのタグを簡単に生成することが出来るプラグインです。
また、[pp]というショートコードの使用も可能にします。
使用例：[pp url='http://www.yahoo.com' width='800' height='500' comment='Yahoo!' caution='** Yahoo!' class='link' style='display:block;']Yahoo! com[/pp]
このショートコードは下記のHTMLを出力します。
&lt;a href="javascript:void(0);" onclick="openPPLT('http://www.yahoo.com','800','500','Yahoo!','** Yahoo!');" class="link" style="display:block;"&gt;Yahoo!
com&lt;/a&gt;

It is plug-in which can generate the tag of pretty photo easily.
Moreover, use of the short code [pp] is also enabled.
Example of use : [pp url='http://www.yahoo.com' width='800' height='500' comment='Yahoo!' caution='** Yahoo!' class='link' style='display: block;']Yahoo! com [/pp]
This short code outputs the following HTML.
&lt;a href="javascript:void(0);" onclick="openPPLT('http://www.yahoo.com','800','500','Yahoo!','** Yahoo!');" class="link" style="display:block;"&gt;Yahoo!
com&lt;/a&gt;

[利用方法 The usage]

1.PrettyPhotoで開くリンクにしたい文字列を書きます。
A character string to make the link opened by PrettyPhoto is written.

2.文字列を選択し[prettyPhoto]ボタンを押します。すると、Pretty Photoの設定画面が表示されます。
A character string is chosen and the [prettyPhoto] button is pushed. Then, the setting screen of Pretty Photo is displayed.

3.必要事項を記入し「Submit」ボタンを押します。
Necessary information is filled in and the "Submit" button is pushed.

4.選択された文字列に対し、prettyPhotoで開くようなHTMLタグが生成されます。
A HTML tag which is opened by prettyPhoto is generated to the selected character string.



制作：佐藤　毅（さとう　たけし） <a href="http://gti.jp/" target="_blank">福岡 システム開発・ホームページ制作</a> 株式会社ジーティーアイ代表
WORK: Takeshi Satoh <a href="http://gti.jp/" target="_blank">GTI Inc.</a>
== Installation ==

インストールする場合は、ダッシュボードの「プラグイン」メニューから
「新規追加」をクリックして、「キーワード」に「Pretty Photo Link Tag」と入力し「プラグインの検索」を行って
結果に現れた「Pretty Photo Link Tag」をインストールしてください。

または、ダウンロードした「pretty-photo-link-tag」フォルダを
FTPなどで　/wp-content/plugins/ ディレクトリにアップロードし
「プラグイン」メニューより「Pretty Photo Link Tag」を「有効化」してご利用ください。

e.g.

1. Upload `pretty-photo-link-tag` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= A question that someone might have =

= What about foo bar? =


== Screenshots ==

&middot; screenshot-01<br /><img src="http://plugins.svn.wordpress.org/pretty-photo-link-tag-generator/tags/0.2/screenshot-01.png" /><br />
&middot; screenshot-02<br /><img src="http://plugins.svn.wordpress.org/pretty-photo-link-tag-generator/tags/0.2/screenshot-02.png" /><br />
&middot; screenshot-03<br /><img src="http://plugins.svn.wordpress.org/pretty-photo-link-tag-generator/tags/0.2/screenshot-03.png" /><br />
&middot; screenshot-04<br /><img src="http://plugins.svn.wordpress.org/pretty-photo-link-tag-generator/tags/0.2/screenshot-04.png" /><br />
&middot; screenshot-05<br /><img src="http://plugins.svn.wordpress.org/pretty-photo-link-tag-generator/tags/0.2/screenshot-05.png" /><br />
&middot; screenshot-06<br /><img src="http://plugins.svn.wordpress.org/pretty-photo-link-tag-generator/tags/0.2/screenshot-06.png" /><br />

== Changelog ==

= 0.2 =
文言の国際化対応
Internationalization correspondence of wording

= 0.1.1 =
Windowをdraggableにした。
Window is changed into draggable.

= 0.1 =
新規作成
New creation

== Upgrade Notice ==

= 0.1 =
とりあえず作りました！

== Arbitrary section ==

== A brief Markdown Example ==
