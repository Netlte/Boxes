<?php declare(strict_types = 1);

namespace Netlte\Boxes;

use Nette\SmartObject;


/**
 * @internal
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 *
 * @method onClick(Tool $sender)
 */
final class Tool {

	use SmartObject;

	public const DEFAULT_ICON_PREFIX = 'fa fa-';

	public static string $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var \Closure[]|callable[]|array */
	public array $onClick = [];
	private string $icon;
	private bool $ajax = true;
	private ?string $color = null;
	private ?string $title = null;


	public function __construct(string $icon, ?string $title = null, ?string $color = null) {
		$this->color = $color;
		$this->icon = $icon;
		$this->title = $title;
	}

	public function isAjaxEnabled(): bool {
		return $this->ajax;
	}

	public function setAjax(bool $enable = true): self {
		$this->ajax = $enable;
		return $this;
	}

	public function getColor(): ?string {
		return $this->color;
	}

	public function setColor(?string $color): self {
		$this->color = $color;
		return $this;
	}

	public function getIcon(): string {
		return $this->icon;
	}

	public function getFQNIcon(): string {
		return self::$ICON_PREFIX . $this->getIcon();
	}

	public function setIcon(string $icon): self {
		$this->icon = $icon;
		return $this;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function setTitle(?string $title): self {
		$this->title = $title;
		return $this;
	}

	public function invokeClick(): void {
		$this->onClick($this);
	}


}
