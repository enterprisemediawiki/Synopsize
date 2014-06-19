<?php
/**
 * Internationalisation file for extension Synopsize.
 *
 * @file
 * @ingroup Extensions
 */
$magicWords = array();
$messages = array();

/** English **/
$messages['en'] = array(
	'synopsize'         => 'Synopsize',
	'synopsize-desc'    => 'Enables the synopsize parser function.',
);


# The $magicWords array is where we'll declare the name of our parser function
# Below we've declared that it will be called "synopsize", and thus will be
# called in wikitext by doing {{#synopsize: example | parameters }}
#
# Note that often magic words are declared in another file called something 
# like "Synopsize.i18n.magic.php", but to keep it simple we'll do
# it here instead.
$magicWords['en'] = array(
   'synopsize' => array(
   		0,            // zero means case-insensitive, 1 means case sensitive
   		'synopsize' // parser function in this language. For English this will probably be the same as above
   	),
);
