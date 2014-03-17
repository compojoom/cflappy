<?php
/**
 * @package    mod_cflappy
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.03.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
JHtml::stylesheet('media/mod_cflappy/css/main.css');

JHtml::_('jquery.framework');
JHtml::script('media/mod_cflappy/js/buzz.min.js');
JHtml::script('media/mod_cflappy/js/jquery.transit.min.js');


JHtml::script('media/mod_cflappy/js/main.js');
$document->addScriptDeclaration("var config = {'url' : '" . JUri::root() . "'}; new Cflappy(jQuery, config)");

$playersConfig = explode("\n",$params->get('players'));
foreach($playersConfig as $key => $config) {
	$player = explode('=', $config, 3);
	$players[$player[0]] = array(
		'name' => htmlentities($player[1]),
		'slogan' => htmlentities($player[2])
	);
}

if(!$players){
	JFactory::getApplication()->enqueueMessage('You need to create at least 1 player in the backend!');
}
?>
<div class="cflappy">
	<div class="cflappy-menu">
		<div id="full-screen" class="btn btn-small pull-right">Fullscreen</div>
		<div class="pull-right">
			Play as:
			<select id="cflappy-players">
				<?php foreach($players as $key => $player) : ?>
					<?php var_dump(htmlentities($player['slogan'])); ?>
					<option value="<?php echo $key; ?>" data-slogan="<?php echo ($player['slogan']); ?>"><?php echo $player['name']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div id="gamecontainer">
		<div id="gamescreen">
			<div id="sky" class="animated">
				<div id="flyarea">
					<div id="ceiling" class="animated"></div>
					<!-- This is the flying and pipe area container -->
					<div id="player" class="bird animated"></div>

					<div id="bigscore"></div>

					<div id="splash"></div>

					<div id="scoreboard">
						<div id="medal"></div>
						<div id="currentscore"></div>
						<div id="highscore"></div>
						<div id="replay"><img src="<?php echo Juri::root(); ?>media/mod_cflappy/assets/replay.png" alt="replay"></div>
						<div id="cflappy-slogan"></div>
					</div>

					<!-- Pipes go here! -->
				</div>

			</div>
			<div id="land" class="animated">
				<div id="debug"></div>
			</div>
		</div>
	</div>
</div>