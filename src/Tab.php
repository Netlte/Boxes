<?php declare(strict_types = 1);

namespace Netlte\Boxes;

use Netlte\UI\RenderableContainer;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class Tab extends RenderableContainer implements ITab {

	private string $label;

	public function __construct(string $label) {
		$this->label = $label;
	}
	
	public function getLabel(): string {
		return $this->label;
	}

	public function setLabel(string $label): ITab {
		$this->label = $label;
		return $this;
	}

}
