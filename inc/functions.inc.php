<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 18.04.2017
 * Time: 12:25
 */

/**
 * Cleans all malicious Data from User-Input
 * @param $input
 * @param string $encoding
 * @return string
 */
function cleanVal( $input , $encoding = 'UTF-8') {
	return htmlspecialchars(
		strip_tags($input),
		ENT_QUOTES | ENT_HTML5,
		$encoding
	);
}

/**
 * Redirects to a certain URL via header('Location')
 * @param String $url
 */
function redirect( String $url ) {
	header('Location: ' . $url);
	exit;
}