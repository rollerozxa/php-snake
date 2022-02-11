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