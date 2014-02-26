<?php
/** 
 * The BlankParserFunction extension enables the my-function parser function.
 * 
 * Documentation: http://???
 * Support:       http://???
 * Source code:   http://???
 *
 * @file BlankParserFunction.php
 * @addtogroup Extensions
 * @author YOURNAME
 * @copyright © 2014 by YOURNAME
 * @licence GNU GPL v3+
 */

# Not a valid entry point, skip unless MEDIAWIKI is defined
if (!defined('MEDIAWIKI')) {
	die( "BlankParserFunction extension" );
}

$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'BlankParserFunction',
	'url'            => 'http://github.com/jamesmontalvo3/MediaWiki-BlankParserFunction',
	'author'         => 'James Montalvo',
	'descriptionmsg' => 'blankparserfunction-desc',
	'version'        => '0.1.0'
);

# $dir: the directory of this file, e.g. something like:
#	1)	/var/www/wiki/extensions/BlankParserFunction
# 	2)	C:/xampp/htdocs/wiki/extensions/BlankParserFunction
$dir = dirname( __FILE__ ) . '/';

# Location of "message file". Message files are used to store your extension's text
#	that will be displayed to users. This text is generally stored in a separate
#	file so it is easy to make text in English, German, Russian, etc, and users can
#	easily switch to the desired language.
$wgExtensionMessagesFiles['BlankParserFunction'] = $dir . 'BlankParserFunction.i18n.php';

# The "body" file will contain the bulk of a simple parser function extension. 
#	NEED MORE INFO HERE.
#
$wgAutoloadClasses['BlankParserFunction'] = $dir . 'BlankParserFunction.body.php';

# This specifies the function that will initialize the parser function.
#	NEED MORE INFO HERE.
#
$wgHooks['ParserFirstCallInit'][] = 'BlankParserFunction::setup';