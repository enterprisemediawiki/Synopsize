<?php
/** 
 * The Synopsize extension enables the my-function parser function.
 * 
 * Documentation: http://???
 * Support:       http://???
 * Source code:   https://github.com/enterprisemediawiki/Synopsize
 *
 * @file Synopsize.php
 * @addtogroup Extensions
 * @author Jamesmontalvo3
 * @copyright © 2014 by James Montalvo
 * @licence GNU GPL v3+
 */

# Not a valid entry point, skip unless MEDIAWIKI is defined
if (!defined('MEDIAWIKI')) {
	die( "Synopsize extension" );
}

$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'Synopsize',
	'url'            => 'https://github.com/enterprisemediawiki/Synopsize',
	'author'         => '[http://www.mediawiki.org/wiki/User:Jamesmontalvo3 James Montalvo]',
	'descriptionmsg' => 'Synopsize-desc',
	'version'        => '0.1.0'
);

# $dir: the directory of this file, e.g. something like:
#	1)	/var/www/wiki/extensions/Synopsize
# 	2)	C:/xampp/htdocs/wiki/extensions/Synopsize
$dir = dirname( __FILE__ ) . '/';

# Location of "message file". Message files are used to store your extension's text
#	that will be displayed to users. This text is generally stored in a separate
#	file so it is easy to make text in English, German, Russian, etc, and users can
#	easily switch to the desired language.
$wgExtensionMessagesFiles['Synopsize'] = $dir . 'Synopsize.i18n.php';

# The "body" file will contain the bulk of a simple parser function extension. 
#	NEED MORE INFO HERE.
#
$wgAutoloadClasses['Synopsize'] = $dir . 'Synopsize.class.php';

# This specifies the function that will initialize the parser function.
#	NEED MORE INFO HERE.
#
$wgHooks['ParserFirstCallInit'][] = 'Synopsize::setup';