<?php /*@charset "utf-8"*/

/*********************************************************************
 Plugin Name:   Pretty Photo Link Tag Generator
 Plugin URI:	http://gti.jp/pplt/
 Description:   prettyPhotoで特定ページを表示するプラグイン
 Author:		Takeshi Satoh
 Version:	   0.2
 Author URI:	http://gti.jp/
 *********************************************************************/
/*********************************************************************
 0.2 国際化
 *********************************************************************/
/** プロセス */
add_action( 'init', 'pretty_photo_link_tag_generator_load_textdomain' );
function pretty_photo_link_tag_generator_load_textdomain() {
	load_plugin_textdomain( 'pretty-photo-link-tag-generator', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
$pretty_photo_link_tag = new pretty_photo_link_tag;

	class pretty_photo_link_tag {

		// version
		var $version = '0.2';

		// プラグインURL
		private $pluginDirUrl;

		//--------------------------------------------------------------------
		// 初期化
		//--------------------------------------------------------------------
		public function __construct() {
			wp_enqueue_script('jquery');
			$this->pluginDirUrl = WP_PLUGIN_URL . '/' . array_pop( explode( DIRECTORY_SEPARATOR, dirname( __FILE__ ) ) ) . "/";
			add_action('wp_head', array(&$this, 'pluginAddHeaderFirst'), 11);
			add_action('wp_head', array(&$this, 'pluginAddHeaderSecond'), 15);
			add_action('admin_head', array(&$this, 'pluginAddAdminHeader'), 30);
			add_shortcode('pp', array(&$this, 'pplt_sc'));

			add_action('admin_print_footer_scripts', array(&$this, 'add_pp_html_button'),50);

			/** 拡張用 */
		}

		// $content はタグと閉じタグに挟まれた内容の部分です。
		function pplt_sc( $atts, $content = "" )
		{
			//パラメータから変数へ代入
			extract( shortcode_atts( array(
				'url'     => '',
				'width'   => 500,
				'height'  => 500,
				'comment' => '',
				'caution' => '',
				'class'   => '',
				'style'   => ''
			), $atts) );

			$url     = $atts['url'];
			$width   = $atts['width'];
			$height  = $atts['height'];
			$comment = $atts['comment'];
			$caution = $atts['caution'];
			$class   = $atts['class'];
			$style   = $atts['style'];

			//出力するHTML
			$html = '<a href="javascript:void(0);" onclick="openPPLT(\''.$url.'\',\''.$width.'\',\''.$height.'\',\''.$comment.'\',\''.$caution.'\');"';
			if ($class != NULL && strlen($class) > 0) {
				$html .= ' class="'.$class.'"';
			}
			if ($style != NULL && strlen($style) > 0) {
				$html .= ' style="'.$style.'"';
			}
			$html .= ">";
			$html .= $content;
			$html .= "</a>";
			return $html;
		}

		function pluginAddHeaderFirst() {
			wp_enqueue_style('pretty_photo', $this->pluginDirUrl.'css/prettyPhoto.css');
			wp_enqueue_script('pretty_photo', $this->pluginDirUrl.'js/jquery.prettyPhoto.js', array('jquery'));
		}

		function pluginAddHeaderSecond() {
echo <<<EOF
<script type="text/javascript">
function openPPLT(url, width, height, comment, caution) {
	if (url != null && url.length > 0) {
		jQuery.prettyPhoto.open(url+'?iframe=true&width='+width+'&height='+height,comment,caution);
	}
	return false;
}
jQuery(document).ready(function(){
jQuery("area[rel^='prettyPhoto']").prettyPhoto();
});
</script>
EOF;
		}

		function pluginAddAdminHeader() {
			wp_enqueue_script('jquery-ui-core', array('jquery'));
			wp_enqueue_script('jquery-ui-draggable', array('jquery'));
			wp_enqueue_script('jquery-ui-resizable', array('jquery'));
			wp_enqueue_script('wp-jquery-ui-dialog', array('jquery'));
echo <<<EOF
<style type="text/css">
<!--
#ppltSetting {
	background: #fff;
	border: 2px solid #ccc;
	padding: 10px;
	margin: 10px 20%;
	display: none;
	position: fixed;
	top: 20px;
	left: 20px;
}
.ppltSetting_fakebutton {
	display: block;
	float: left;
	margin-right: 1em;
	width: 5em;
	border: 3px #666 outset;
	cursor: default;
	text-align: center;
}
.ppltSetting_fakebutton:active {
	border: 3px #666 inset;
}
.ppltSetting_clear { clear: both; }
.ppltSetting_low { font-size: 1px; line-height: 1px; }
.ppltSetting_labelcontainer { display: block; width: 128px; float: left; }
-->
</style>
EOF;
		}

		// 編集画面にPrettyPhotoボタン追加
		function add_pp_html_button() {
			// 投稿の編集画面だけを対象とする
			if( strpos( $_SERVER[ "REQUEST_URI" ], "post.php"	 ) ||
				strpos( $_SERVER[ "REQUEST_URI" ], "post-new.php" ) ||
				strpos( $_SERVER[ "REQUEST_URI" ], "page-new.php" ) ||
				strpos( $_SERVER[ "REQUEST_URI" ], "page.php"	 ) )
			{
?>
<script type="text/javascript">
//<![CDATA
	  QTags.addButton('ed_pplt', 'PrettyPhoto', tagOpen, '</a>');

	  function tagOpen() {
		jQuery("#ppltSetting").dialog({
				bgiframe: true,
				autoOpen: false,
				height: 500,
				modal: true,
				draggable: true
			  });
		jQuery('#ppltSetting').dialog('open');
		jQuery('#ppltSetting').draggable();
		   var myObj = document.getElementById('ppltSetting');
		   if (myObj !== null) {
			 document.getElementById('ppltStr').value = getText();
		   }
	  }

	  function ppltSettingErrMessage(num) {
		return '';
	  }

	  function ppltSettingGetValue(myId) {
		var myObj = document.getElementById(myId);
		if (myObj !== null) {
		  if (myObj.value !== undefined) {
			return myObj.value;
		  }
		  else {
			return '';
		  }
		}
		else {
		  return '';
		}
	  }

	  function ppltSettingSubmitLine() {
		var ppltSettingCONTENT = ppltSettingGetValue('ppltStr');
		var ppltSettingURL     = ppltSettingGetValue('urlstr');
		var ppltSettingWidth   = ppltSettingGetValue('width');
		var ppltSettingHeight  = ppltSettingGetValue('height');
		var ppltSettingComment = ppltSettingGetValue('comment');
		var ppltSettingCaution = ppltSettingGetValue('caution');
		var ppltSettingClass   = ppltSettingGetValue('class');
		var ppltSettingStyle   = ppltSettingGetValue('style');

		var prefix = "";
		var suffix = "";
		var copybuffer = '';
		if (ppltSettingURL != '') {
			prefix = '<a href="javascript:void(0);" onclick="openPPLT(\''+ppltSettingURL+'\',\''+ppltSettingWidth+'\',\''+ppltSettingHeight+'\',\''+ppltSettingComment+'\',\''+ppltSettingCaution+'\');"';
			if (ppltSettingClass != '' && ppltSettingClass.length > 0) {
				prefix += ' class="'+ppltSettingClass+'"';
			}
			if (ppltSettingStyle != '' && ppltSettingStyle.lenght > 0) {
				prefix += ' style="'+ppltSettingStyle+'"';
			}
			prefix += ">";
			suffix = '</a>';
		} else {
			alert('<?php _e('URL is not inputted.', 'pretty-photo-link-tag-generator'); ?>');
			return false;
		}

		var myContent = document.getElementById('content');
		if (myContent !== null) {
		  copybuffer = prefix + ppltSettingCONTENT + suffix;
		  QTags.insertContent(copybuffer);
		  ppltSettingCancelLine();
		}
	  }

	  function ppltSettingCancelLine() {
		var myObj = document.getElementById('ppltSetting');
		if (myObj !== null) {
		  jQuery('#ppltSetting').dialog('close');
		}
	  }

	function getText() {
		var selected_value = "";
		if(document.selection) { // IE
			var range = document.selection.createRange();
			selected_value = range.text;
		} else { // not IE
			var org = document.getElementById("content");
			var start = org.selectionStart;
			var end = org.selectionEnd;
			selected_value = org.value.substring(start, end);
		}
		return selected_value;
	}
//]]>
</script>
  <div id="ppltSetting" class="stuffbox" onblur="ppltSettingCancelLine(); return false;">
	<h2><?php _e('Pretty Photo Properties.', 'pretty-photo-link-tag-generator'); ?></h2>

	<form method="GET" action="#">
	  <input type="hidden" id="ppltStr" value="" />
	  <p class="clear">
		<span class="ppltSetting_labelcontainer"><label><?php _e('URL', 'pretty-photo-link-tag-generator'); ?></label>*:</span>
		<input type="text" name="urlstr" id="urlstr" size="80" />
		<br /><small class="howto"><?php _e('URL of the page/picture displayed by Pretty Photo', 'pretty-photo-link-tag-generator'); ?></small>
	  </p>
	  <p class="clear">
		<span class="ppltSetting_labelcontainer"><label><?php _e('Window width of Pretty Photo', 'pretty-photo-link-tag-generator'); ?></label>:</span>
		<input type="text" name="width" id="width" size="5" />px
	  </p>
	  <p class="clear">
		<span class="ppltSetting_labelcontainer"><label><?php _e('Window height of Pretty Photo', 'pretty-photo-link-tag-generator'); ?></label>:</span>
		<input type="text" name="height" id="height" size="5" />px
	  </p>
	  <p class="clear">
		<span class="ppltSetting_labelcontainer"><label><?php _e('TITLE', 'pretty-photo-link-tag-generator'); ?></label>:</span>
		<input type="text" name="comment" id="comment" size="50" />
	  </p>
	  <p class="clear">
		<span class="ppltSetting_labelcontainer"><label><?php _e('CAUTION', 'pretty-photo-link-tag-generator'); ?></label>:</span>
		<input type="text" name="caution" id="caution" size="50" />
		<br /><small class="howto"><?php _e('The character string displayed on the window lower parts, such as notes', 'pretty-photo-link-tag-generator'); ?></small>
	  </p>
	  <p class="clear">
		<span class="ppltSetting_labelcontainer"><label><?php _e('The class property used with &lt;a&gt; tag ', 'pretty-photo-link-tag-generator'); ?></label>:</span>
		<input type="text" name="class" id="class" size="50" />
		<br /><small class="howto"><?php _e('* If it is, please input.', 'pretty-photo-link-tag-generator'); ?></small>
	  </p>
	  <p class="clear">
		<span class="ppltSetting_labelcontainer"><label><?php _e('The style property used with &lt;a&gt; tag ', 'pretty-photo-link-tag-generator'); ?></label>:</span>
		<input type="text" name="style" id="style" size="50" />
		<br /><small class="howto"><?php _e('* If it is, please input.', 'pretty-photo-link-tag-generator'); ?></small>
	  </p>
	  <p class="clear">
		<!-- input type="submit" name="submit" value="Submit" onclick="ppltSettingSubmitLine(); return false;" />
		<input type="submit" name="cancel" value="Cancel" onclick="ppltSetting_CancelLine(); return false;" / -->
		<span class="button" onclick="ppltSettingSubmitLine(); return false;"><?php _e('Submit', 'pretty-photo-link-tag-generator'); ?></span>
		<a href="javascript:void(0);" onclick="ppltSettingCancelLine(); return false;"><?php _e('Cancel', 'pretty-photo-link-tag-generator'); ?></a>
	  </p>
	  <div class="ppltSetting_clear ppltSetting_low"><!-- --></div>
	</form>
  </div> <!-- #ppltSetting -->
<?php
			}
		}
	}
