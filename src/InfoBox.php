<?php declare(strict_types = 1);

namespace Netlte\Boxes;

use Nette\ArgumentOutOfRangeException;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class InfoBox extends AbstractBox {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'info-box.latte';
	public const DEFAULT_ICON_PREFIX = 'ion ion-';

	public const PROGRESS_FROM = 0;

	public const PROGRESS_TO = 100;

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;
	public static string $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	private float $value = 0.0;

	private ?float $progress = null;

	private ?string $description = null;

	public function __construct(
		string $text,
		?string $icon = null,
		?string $background = null,
		float $value = 0.0,
		?float $progress = null,
		?string $description = null
	) {
		parent::__construct($text, $icon, $background);
		self::progressCheck($progress);
		$this->value = $value;
		$this->progress = $progress;
		$this->description = $description;
	}

	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	public function getValue(): float {
		return $this->value;
	}

	public function setValue(float $value): self {
		$this->value = $value;
		return $this;
	}

	public function getProgress(): ?float {
		return $this->progress;
	}

	public function setProgress(?float $progress = null): self {
		self::progressCheck($progress);
		$this->progress = $progress;
		return $this;
	}

	public function getDescription(): ?string {
		return $this->description;
	}

	public function setDescription(?string $description = null): self {
		$this->description = $description;
		return $this;
	}

	protected static function progressCheck(?float $progress = null): void {
		if ($progress !== null && ($progress < self::PROGRESS_FROM || $progress > self::PROGRESS_TO)) {
			throw new ArgumentOutOfRangeException(
				\sprintf(
					'Progress value should be between %f and %f, %f given',
					self::PROGRESS_FROM,
					self::PROGRESS_TO,
					$progress
				)
			);
		}
	}

}
