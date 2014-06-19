<?php
/**
 * @file Synopsize.body.php
 * @addtogroup Extensions
 * @author Jamesmontalvo3
 * @copyright © 2014 by James Montalvo
 * @licence GNU GPL v3+
 */

class Synopsize
{

	static function setup ( &$parser ) {
		
		$parser->setFunctionHook(
			'synopsize', // the name of your parser function, the same as the $magicWords value you set in Synopsize.i18n.php 
			array(
				'Synopsize',  // class to call function from
				'renderSynopsize' // function to call within that class
			),
			SFH_OBJECT_ARGS // defines the format of how data is passed to your function...don't worry about it for now.
		);

		return true;
		
	}
	
	static function processArgs( $frame, $args, $defaults ) {
		$new_args = array();
		for ($i=0; $i<count($args); $i++) {
			if ( isset($args[$i]) )
				$new_args[$i] = trim( $frame->expand($args[$i]) );
			else
				$new_args[$i] = $defaults[$i];
		}
		return $new_args;
	}

	static function renderSynopsize ( &$parser, $frame, $args ) {

		$args = self::processArgs( $frame, $args, array("", 255, 1) );
	
		// self::addJSandCSS(); // adds the javascript and CSS files 
		
		$full_text  = $args[0];
		$max_length = $args[1];
		$max_lines  = $args[2];
		
		$needle = "\n";
		for($i=0; $i<$max_lines; $i++) {
			if ($newline_pos)
				$offset = $newline_pos + strlen($needle);
			else
				$offset = 0;
			$newline_pos = strpos($full_text, $needle, $offset );
			
		}
		
		// trim to specified number of newlines
		$synopsis = substr($full_text, 0, $newline_pos);
		
		// trim at max characters
		if (strlen($synopsis) > $max_length) {
			$synopsis = substr($synopsis, 0, $max_length);
			$last_space = strrpos($synopsis, ' ');
			$synopsis = substr($synopsis, 0, $last_space) . ' ...';
		}

		return $synopsis;
	}
	
	// static function addJSandCSS () {
	
		// global $wgOut, $wgExtensionAssetsPath;
		
		// $wgOut->addScriptFile( "$wgExtensionAssetsPath/Synopsize/Synopsize.js" );

		// $wgOut->addLink( array(
			// 'rel' => 'stylesheet',
			// 'type' => 'text/css',
			// 'media' => "screen",
			// 'href' => "$wgExtensionAssetsPath/Synopsize/Synopsize.css"
		// ) );
		
		// return true;

	// }
	
}