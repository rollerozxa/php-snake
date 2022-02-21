<?php

function initSDLOrExit() {
	if (SDL_Init(SDL_INIT_EVERYTHING) !== 0) {
		printSdlErrorAndExit();
	}
}

function printSdlErrorAndExit() {
	fprintf(STDERR, "ERROR: %s\n", SDL_GetError());
	exit(1);
}

/**
 * Return an SDL rect of a grid cell.
 */
function gridCell($x, $y) {
	return new SDL_Rect(16 + $x * 48, 16 + $y * 48, 32, 32);
}

/**
 * Check single cell grid collision.
 */
function gridColl($a, $b) {
	return ($a['x'] == $b['x'] && $a['y'] == $b['y']);
}