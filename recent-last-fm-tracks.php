<?php
/*
Plugin Name: Recent LastFm Tracks
Plugin URI: http://www.fabricelaffont.fr/2012/09/24/recent-lastfm-tracks-mise-a-jour/
Description: This simple widget includes lastFm recent Tracks into the sidebar.
Author: SnnOoZe
Version: 1.2.3
Author URI: http://www.fabricelaffont.fr
*/

add_action("wp_head", "init");

function init()
{
	echo "<script type = 'text/javascript' src = '".get_bloginfo('url')."/wp-content/plugins/recent-lastfm-tracks/js/jquery.js'></script>";

}

function recentLastFmTracks_action($username, $limit, $cover_size)
{
	echo "<script type = 'text/javascript'id = 'tumblrScript' src = '".get_bloginfo('url')."/wp-content/plugins/recent-lastfm-tracks/js/fm.js?user=".$username."&limit=".$limit."&cover=".$cover_size."&url=".get_bloginfo('url')."'></script>";
}

function widget_recentLastFmTracks($args) {
  extract($args);

  $options = get_option("widget_recentLastFmTracks");
  if (!is_array( $options ))
{
$options = array(
		'title' => 'Recent LastFM Tracks',
		'username' => '',
		'limit'=>'10',
		'cover_size'=>'50'
      );
  }

  echo $before_widget;
    echo $before_title;
      echo $options['title'];
    echo $after_title;

    //Our Widget Content
    recentLastFmTracks_action($options['username'], $options['limit'], $options["cover_size"]);
  echo $after_widget;
}


// Backend options
function recentLastFmTracks_control()
{
  $options = get_option("widget_recentLastFmTracks");
  if (!is_array( $options )) // Pruefe ob variable KEIN array ist
	{
	$options = array(
		'title' => 'Recent LastFM Tracks',
		'username' => '',
		'limit'=>'10',
		'cover_size'=>'50'
		);
	}


  if(isset($_POST['recentLastFmTracks-Submit']))
  {
  	$options['title'] = htmlspecialchars($_POST['recentLastFmTracks-WidgetTitle']); // variable
	$options['username'] = htmlspecialchars($_POST['recentLastFmTracks-username']); // variable
	$options['limit'] = htmlspecialchars($_POST['recentLastFmTracks-limit']); // variable
	$options['cover_size'] = htmlspecialchars($_POST['recentLastFmTracks-cover_size']); // variable
    update_option("widget_recentLastFmTracks", $options); // in option
  }

?>
  <p>
	<b><?php echo __("Title", "recent-last-fm-tracks"); ?></b><br />
  	<input type="text" id="recentLastFmTracks-WidgetTitle" name="recentLastFmTracks-WidgetTitle" value="<?php echo $options['title'];?>" style="width: 220px;"/>
  	<br />
    <br />
	<b><?php echo __("Insert your LastFm username", "recent-last-fm-tracks"); ?></b><br />
	<input type="text" id="recentLastFmTracks-username" name="recentLastFmTracks-username" value="<?php echo $options['username'];?>" style="width: 220px;" /><br />
	<br />
	<b><?php echo __("Insert the limit of songs to show", "recent-last-fm-tracks"); ?></b><br />
	<input type="text" id="recentLastFmTracks-limit" name="recentLastFmTracks-limit" value="<?php echo $options['limit'];?>" style="width: 220px;" /><br />
	<br />
    <b><?php echo __("Covers size", "recent-last-fm-tracks"); ?></b>
    <input type="text" id="recentLastFmTracks-cover_size" name="recentLastFmTracks-cover_size" value="<?php echo $options['cover_size'];?>" style="width: 220px;"/>
    <input type="hidden" id="recentLastFmTracks-Submit" name="recentLastFmTracks-Submit" value="1" />
  </p>
<?php
}

function recentLastFmTracks_init() {
	$plugin_dir = basename(dirname(__FILE__));
	 load_plugin_textdomain( 'recent-last-fm-tracks', false, $plugin_dir.'/i18n/');
	// setup of the widget
	wp_register_sidebar_widget(
		'widget_recentLastFmTracks',
		'Recent LastFm Tracks',
		'widget_recentLastFmTracks',
		array(
			'description' => 'This simple widget includes your lastFm recent Tracks into the sidebar.'
		)
	);
	wp_register_widget_control( 'widget_recentLastFmTracks', 'Recent LastFm Tracks', 'recentLastFmTracks_control', 300, 200 );
}

add_action("plugins_loaded", "recentLastFmTracks_init");

?>