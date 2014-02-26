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

class IMSQuery
{

	static function setup ( &$parser ) {
		
		$parser->setFunctionHook( 'ims', array( 'IMSQuery', 'renderIMSQuery' ), SFH_OBJECT_ARGS );

		return true;
		
	}
	

	static function renderIMSQuery ( &$parser, $frame, $args ) { // $pagesToCopyArray, $showOutput ) {
		global $wgCanonicalNamespaceNames;

		self::addJSandCSS();
		
		$part_number = trim( $frame->expand($args[0]) );
		if ( count($args) > 1 )
			$serial_number = trim( $frame->expand($args[1]) );
		else
			$serial_number = false;
		
		if ( count($args) > 2 )
			$cage_code = trim( $frame->expand($args[2]) );
		else
			$cage_code = "NASA";
			
		$text = Xml::tags(
			'small',
			array(),
			"Note: the following data is pulled from the IMS database via a third-party script. <span style='color:red;'>Use the IMS Client before making mission decisions.</span>"
		);
		
		// use P/N only
		if ($serial_number === false)
			$text .= "<div class='ims-part-number-search'>Loading IMS data for part number <span class='ims-partnumber'>$part_number</span>...</div>";
		
		// use P/N, S/N and Cage Code
		else
			$text .= "<div class='ims-item-search'>Loading IMS data for Part/Serial/Cage <span class='ims-partnumber'>$part_number</span> / <span class='ims-serialnumber'>$serial_number</span> / <span class='ims-cagecode'>$cage_code</span>...</div>";
		
		// global $wgOut;
		// $wgOut->addHTML($text);
		return $text;
		// return "";
	}
	
	static function addJSandCSS () {
	
		global $wgOut, $wgExtensionAssetsPath;
		
		$wgOut->addScriptFile( "$wgExtensionAssetsPath/IMSQuery/IMSQuery.js" );

		$wgOut->addLink( array(
			'rel' => 'stylesheet',
			'type' => 'text/css',
			'media' => "screen",
			'href' => "$wgExtensionAssetsPath/IMSQuery/IMSQuery.css"
		) );
		
		return true;

	}
	
}