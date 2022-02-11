<?php

class Game {
	private $snake = [
		[ 'x' => 3, 'y' => 4 ],
		[ 'x' => 4, 'y' => 4 ],
		[ 'x' => 5, 'y' => 4 ],
		[ 'x' => 6, 'y' => 4 ]
	];

	function __construct() {

	}

	function update(&$event) {

	}

	function draw(&$renderer) {
		SDL_SetRenderDrawColor($renderer, 10, 10, 10, 255);
		for ($x = 0; $x < 26; $x++) {
			for ($y = 0; $y < 14; $y++) {
				SDL_RenderFillRect($renderer, $this->gridCell($x, $y));
			}
		}

		SDL_SetRenderDrawColor($renderer, 0, 127, 0, 255);
		foreach ($this->snake as $limb) {
			SDL_RenderFillRect($renderer, $this->gridCell($limb['x'], $limb['y']));
		}
	}

	/**
	 * Return an SDL rect of a grid cell.
	 */
	private function gridCell($x, $y) {
		return new SDL_Rect(16 + $x * 48, 16 + $y * 48, 32, 32);
	}
}
