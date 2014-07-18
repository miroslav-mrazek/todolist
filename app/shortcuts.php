<?php

/**
 * Zkratky pro často používané funkce
 */

use Tracy\Debugger;

if (!function_exists('barDump')) {
	/**
	 * Tracy\Debugger::barDump() shortcut.
	 * @tracySkipLocation
	 */
   function barDump($var, $title = '')
   {
	   $backtrace = debug_backtrace();
	   $source = (isset($backtrace[1]['class'])) ?
		   $backtrace[1]['class'] :
		   basename($backtrace[0]['file']);
	   $line = $backtrace[0]['line'];
	   $title .= (empty($title) ? '' : ' – ');

	   return Debugger::barDump($var, $title . $source . ' (' . $line . ')');
   }

}
