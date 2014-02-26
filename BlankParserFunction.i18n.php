<?php
/**
 * Internationalisation file for extension BlankParserFunction.
 *
 * @file
 * @ingroup Extensions
 */
$magicWords = array();
$messages = array();

/** English **/
$messages['en'] = array(
	'blankparserfunction'         => 'BlankParserFunction',
	'blankparserfunction-desc'    => 'Enables the my-function parser function.',
);

/** German **/
$messages['de'] = array(
	'blankparserfunction'         => 'German translation of "BlankParserFunction"',
	'blankparserfunction-desc'    => 'German translation of "Enables the my-function parser function"'
);

# The $magicWords array is where we'll declare the name of our parser function
# Below we've declared that it will be called "my-function", and thus will be
# called in wikitext by doing {{#my-function: example | parameters }}
#
# Note that often magic words are declared in another file called something 
# like "BlankParserFunction.i18n.magic.php", but to keep it simple we'll do
# it here instead.
$magicWords['en'] = array(
   'my-function' => array(
   		0,            // zero means case-insensitive, 1 means case sensitive
   		'my-function' // parser function in this language. For English this will probably be the same as above
   	),
);

$magicWords['de'] = array(
   'my-function' => array( 0, 'meine-funktion' ),
);
