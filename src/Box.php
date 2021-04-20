<?php declare(strict_types = 1);

namespace Netlte\Boxes;

use Netlte\Boxes\Exceptions\BadRequestException;
use Netlte\UI\AbstractControl;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class Box extends AbstractControl {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'box.latte';
	public const DEFAULT_ICON_PREFIX = 'fa fa-';
	public const DEFAULT_BACKGROUND = 'default';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;
	public static string $DEFAULT_BACKGROUND = self::DEFAULT_BACKGROUND;
	public static string $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var Tool[] */
	private array $tools = [];
	private ?string $title = null;
	private string $background = self::DEFAULT_BACKGROUND;
	private bool $solid = true;
	private bool $collapsed = false;
	private bool $collapsable = false;
	private bool $removable = false;
	private bool $overlay = false;
	private bool $padding = true;
	private bool $border = true;

	public function __construct(?string $title = null) {
		$this->title = $title;
		$this->background = self::$DEFAULT_BACKGROUND;
	}


	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	public function handleTool(string $tool): void {
		$t = $this->getTool($tool);
		if ($t === null) {
			throw new BadRequestException("Tool with name {$tool} not found");
		}

		$t->invokeClick();
	}

	public function getBackground(): string {
		return $this->background;
	}

	public function isCollapsed(): bool {
		return $this->collapsed;
	}

	public function isCollapsable(): bool {
		return $this->collapsable;
	}

	public function hasPadding(): bool {
		return $this->padding;
	}

	public function hasBorder(): bool {
		return $this->border;
	}

	public function hasTools(): bool {
		return  \count($this->tools) > 0 || $this->isCollapsable() || $this->isRemovable();
	}

	/**
	 * @return Tool[]
	 */
	public function getTools(): array {
		return $this->tools;
	}

	public function getTool(string $name): ?Tool {
		return $this->tools[$name] ?? null;
	}

	public function removeTool(string $name): self {
		if (isset($this->getTools()[$name])) {
			unset($this->tools[$name]);
		}

		return $this;
	}

	public function addTool(string $name, string $icon): Tool {
		$tool = new Tool($icon);
		$this->tools[$name] = $tool;
		return $tool;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function isSolid(): bool {
		return $this->solid;
	}

	public function isRemovable(): bool {
		return $this->removable;
	}

	public function hasOverlay(): bool {
		return $this->overlay;
	}

	public function setBackground(string $background = self::DEFAULT_BACKGROUND): self {
		$this->background = $background;
		return $this;
	}

	public function setCollapsed(bool $collapsed = true): self {
		$this->collapsed = $collapsed;
		$this->setCollapsable($collapsed || $this->isCollapsable());
		return $this;
	}

	public function setCollapsable(bool $collapsable = true): self {
		$this->collapsable = $collapsable;
		return $this;
	}

	public function setPadding(bool $padding = true): self {
		$this->padding = $padding;
		return $this;
	}

	public function setBorder(bool $border = true): self {
		$this->border = $border;
		return $this;
	}

	public function setTitle(?string $title = null): self {
		$this->title = $title;
		return $this;
	}

	public function setSolid(bool $solid = true): self {
		$this->solid = $solid;
		return $this;
	}

	public function setRemovable(bool $removable = true): self {
		$this->removable = $removable;
		return $this;
	}

	public function setOverlay(bool $overlay = true): self {
		$this->overlay = $overlay;
		return $this;
	}


}
