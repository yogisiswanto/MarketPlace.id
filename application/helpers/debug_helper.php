<?php
if ( ! function_exists('debug'))
{
	function debug($value)
	{
	echo "<center><<============================DEBUG TOOL================================>></center>";
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        echo "<center><<=======================================================================>></center>";
        die();
	}
}