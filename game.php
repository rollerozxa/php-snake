<?php

class Game {
	private $snake = [
		[ 'x' => 6, 'y' => 4 ],
		[ 'x' => 5, 'y' => 4 ],
		[ 'x' => 4, 'y' => 4 ],
		[ 'x' => 3, 'y' => 4 ],
	];
	private $snakeHead = [ 'x' => 6, 'y' => 4 ];

	private $apple = [ 'x' => 20, 'y' => 10 ];

	private $direction = 'right';

	private $step = 0;

	private $score = 0;

	function __construct() {
	}

	function update(&$event) {
		$this->step++;

		if ($event->type == SDL_KEYDOWN) {
			switch ($event->key->keysym->sym) {
				case SDLK_LEFT:		$direction = 'left';	break;
				case SDLK_RIGHT:	$direction = 'right';	break;
				case SDLK_UP:		$direction = 'up';		break;
				case SDLK_DOWN:		$direction = 'down';	break;
			}

			$this->direction = $direction;
		}

		if ($this->step % 10 == 0) {
			$newSnakeHead = $this->snakeHead;
			switch ($this->direction) {
				case 'left':	$newSnakeHead['x']--; break;
				case 'right':	$newSnakeHead['x']++; break;
				case 'up':		$newSnakeHead['y']--; break;
				case 'down':	$newSnakeHead['y']++; break;
			}

			$this->snakeHead = $newSnakeHead;
			array_unshift($this->snake, $this->snakeHead);

			if (gridColl($this->snakeHead, $this->apple)) {
				$this->score++;
				while (true) {
					$newApplePos = [
						'x' => rand(0,25),
						'y' => rand(0,13)
					];

					$legalPos = true;
					foreach ($this->snake as $limb) {
						if (gridColl($limb, $newApplePos)) {
							$legalPos = false;
							break;
						}
					}

					if ($legalPos) break;
				}
				$this->apple = $newApplePos;
			} else {
				array_pop($this->snake);
			}
		}
	}

	function draw(&$renderer) {
		SDL_SetRenderDrawColor($renderer, 10, 10, 10, 255);
		for ($x = 0; $x < 26; $x++) {
			for ($y = 0; $y < 14; $y++) {
				SDL_RenderFillRect($renderer, gridCell($x, $y));
			}
		}

		SDL_SetRenderDrawColor($renderer, 0, 127, 0, 255);
		foreach ($this->snake as $limb) {
			SDL_RenderFillRect($renderer, gridCell($limb['x'], $limb['y']));
		}

		SDL_SetRenderDrawColor($renderer, 127, 0, 0, 255);
		SDL_RenderFillRect($renderer, gridCell($this->apple['x'], $this->apple['y']));
	}

	function getTitle() {
		return sprintf("pee haich pee snek - Score: %d", $this->score);
	}
}
