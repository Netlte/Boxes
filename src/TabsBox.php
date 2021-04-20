<?php declare(strict_types = 1);

namespace Netlte\Boxes;

use Netlte\UI\AbstractControl;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
class TabsBox extends AbstractControl {

	public const DEFAULT_TEMPLATE = __DIR__ . \DIRECTORY_SEPARATOR . 'templates' . \DIRECTORY_SEPARATOR . 'tabsbox.latte';

	public static string $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @persistent */
	public ?string $active = null;

	public function __construct(?string $active = null) {
		$this->active = $active;
	}

	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile() ?? self::$DEFAULT_TEMPLATE);
		$this->getTemplate()->render();
	}

	public function addTab(string $name, string $label, ?string $insertBefore = null): Tab {
		$tab = new Tab($label);
		$this->addComponent($tab, $name, $insertBefore);
		return $tab;
	}

	public function getTab(string $name): ?ITab {
		$tab = $this->getComponent($name);
		return $tab instanceof ITab ? $tab : null;
	}

	public function setActiveTab(?string $name = null): self {
		if ($name !== null) {
			// throw exception if Tab not exists
			$this->getComponent($name, true);
		}

		$this->active = $name;
		return $this;
	}

}
