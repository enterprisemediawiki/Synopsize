<?php
/**
 * The BlankParserFunction extension enables the my-function parser function.
 * 
 * Documentation: http://???
 * Support:       http://???
 * Source code:   http://???
 *
 * @file BlankParserFunction.body.php
 * @addtogroup Extensions
 * @author YOUR NAME
 * @copyright © 2014 by YOUR NAME
 * @licence GNU GPL v3+
 */

class BlankParserFunction
{

	static function setup ( &$parser ) {
		
		$parser->setFunctionHook(
			'my-function', // the name of your parser function, the same as the $magicWords value you set in BlankParserFunction.i18n.php 
			array(
				'BlankParserFunction',  // class to call function from
				'renderBlankParserFunction' // function to call within that class
			),
			SFH_OBJECT_ARGS // defines the format of how data is passed to your function...don't worry about it for now.
		);

		return true;
		
	}
	

	static function renderBlankParserFunction ( &$parser, $frame, $args ) {

		self::addJSandCSS(); // adds the javascript and CSS files 
		
		$first_argument = trim( $frame->expand($args[0]) );

		if ( count($args) > 1 )
			$second_argument = trim( $frame->expand($args[1]) );
		else
			$second_argument = "";
		
		$text = $first_argument . " " . $second_argument;
		
		$text = Xml::tags(
			'div',
			array("class" => "MyClass"),
			$first_argument
		);
		
		$text .= $second_argument;
		
		return $text;

	}
	
	static function addJSandCSS () {
	
		global $wgOut, $wgExtensionAssetsPath;
		
		$wgOut->addScriptFile( "$wgExtensionAssetsPath/BlankParserFunction/BlankParserFunction.js" );

		$wgOut->addLink( array(
			'rel' => 'stylesheet',
			'type' => 'text/css',
			'media' => "screen",
			'href' => "$wgExtensionAssetsPath/BlankParserFunction/BlankParserFunction.css"
		) );
		
		return true;

	}
	
}