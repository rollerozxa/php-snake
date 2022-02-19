<?php
declare(strict_types=1);
error_reporting(E_ALL);

require('util.php');
require('game.php');

const WINDOW_WIDTH = 1280;
const WINDOW_HEIGHT = 720;

SDL_Init(SDL_INIT_VIDEO);
$window = SDL_CreateWindow("pee haich pee snek", SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, WINDOW_WIDTH, WINDOW_HEIGHT, SDL_WINDOW_SHOWN);
$renderer = SDL_CreateRenderer($window, 0, SDL_RENDERER_ACCELERATED | SDL_RENDERER_PRESENTVSYNC);

$game = new Game();

while (true) {
	// Wait for quit event
	$event = new SDL_Event;
	if (SDL_PollEvent($event) && $event->type == SDL_QUIT) {
		break;
	}

	$game->update($event);

	SDL_SetWindowTitle($window, $game->getTitle());

	// Clear screen
	SDL_SetRenderDrawColor($renderer, 25, 25, 25, 0);
	SDL_RenderClear($renderer);

	$game->draw($renderer);

	SDL_RenderPresent($renderer);
}

SDL_DestroyRenderer($renderer);
SDL_DestroyWindow($window);
SDL_Quit();
