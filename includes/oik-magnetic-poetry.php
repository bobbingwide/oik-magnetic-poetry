<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2019
 */

/**
 * Magnetic poetry server side rendering
 *
 * @param $attributes
 * @param $content
 * @return mixed
 */
function oikmp_poetry( $attributes, $content ) {
	return oik_magnetic_poetry_example();
	return $content;
}

/**
 * Format a word
 * @param $word
 */
function oikmp_word( $word ) {
	$rotter = oikmp_rotter( $word );
	sepan( "mp $rotter", $word );
}

function oikmp_rotter( $word ) {
	$rot = rand( -10, 10 );
	return "mp$rot";
}



function oik_magnetic_poetry_example() {


	sdiv( "mp");
	sp();
	oikmp_word( "I" );
	oikmp_word( "sometimes" );
	oikmp_word(  "play" );
	oikmp_word( "golf" );
	ep();

	sp();
	oikmp_word( "Hit");
	oikmp_word( "the" );
	oikmp_word( "ball" );
	oikmp_word( "in");
	oikmp_word( "the");
	oikmp_word( "air");
	ediv();
	//bw_flush();
	return bw_ret();

}