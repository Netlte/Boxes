<?php declare(strict_types = 1);

namespace Netlte\Boxes;

/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class SmallBox extends AbstractBox {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'small-box.latte';
	public const DEFAULT_ICON_PREFIX = 'ion ion-';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	public static string $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	private string $header = '';
	private ?string $link = null;
	private bool $smaller = false;


	public function __construct(
		string $text,
		?string $icon = null,
		?string $background = null,
		string $header = '',
		?string $link = null
	) {
		parent::__construct($text, $icon, $background);
		$this->header = $header;
		$this->link = $link;
	}

	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	public function getHeader(): string {
		return $this->header;
	}

	public function setHeader(string $header): self {
		$this->header = $header;
		return $this;
	}

	public function getLink(): ?string {
		return $this->link;
	}

	public function setLink(?string $link = null): self {
		$this->link = $link;
		return $this;
	}

	public function isSmaller(): bool {
		return $this->smaller;
	}

	public function setSmaller(bool $smaller = true): self {
		$this->smaller = $smaller;
		return $this;
	}


}
