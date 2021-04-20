<?php declare(strict_types = 1);

namespace Netlte\Boxes;

use Netlte\UI\IRenderableContainer;


/**
 * @author       Tomáš Holan <tomas@holan.dev>
 * @package      netlte/boxes
 * @copyright    Copyright © 2021, Tomáš Holan [www.holan.dev]
 */
interface ITab extends IRenderableContainer {

	public function getLabel(): string;

	public function setLabel(string $label): ITab;

}