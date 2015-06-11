<?php

/**
 * Module info file that tells ProcessWire about this module.
 *
 * If you prefer to keep everything in the main module file, you can move this
 * to a static getModuleInfo() method in the Helloworld.module.php file, which
 * would return the same array as below.
 *
 * Note: When updating this info for an already-installed module, you'll need
 * to do a Modules > Refresh before you see your updated info.
 *
 */

$info = array(
	'title' => 'Redirect before not found.',
	'summary' => 'Redirect before not found',
	'author' => 'Martijn Geerts',
	'requires' => 'ProcessWire>=2.5.29',
	'version' => 1,
	'autoload' => true,
	'singular' => true,
	'icon' => 'smile-o',
);
