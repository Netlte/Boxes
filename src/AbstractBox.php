<?php declare(strict_types = 1);

namespace Netlte\Boxes;

use Netlte\UI\AbstractControl;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
abstract class AbstractBox extends AbstractControl {

	private ?string $background = null;

	private ?string $icon = null;

	private string $text;


	public function __construct(
		string $text,
		?string $icon = null,
		?string $background = null
	) {
		$this->text = $text;
		$this->icon = $icon;
		$this->background = $background;
	}

	public function getBackground(): ?string {
		return $this->background;
	}

	public function setBackground(?string $background): self {
		$this->background = $background;
		return $this;
	}

	public function getIcon(): ?string {
		return $this->icon;
	}

	public function setIcon(?string $icon = null): self {
		$this->icon = $icon;
		return $this;
	}

	public function getText(): string {
		return $this->text;
	}

	public function setText(string $text): self {
		$this->text = $text;
		return $this;
	}

}
