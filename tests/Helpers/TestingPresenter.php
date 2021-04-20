<?php declare(strict_types = 1);

namespace Netlte\Boxes\Tests\Helpers;

use Netlte\Boxes\Box;
use Netlte\Boxes\InfoBox;
use Netlte\Boxes\SmallBox;
use Netlte\Boxes\TabsBox;
use Nette\Application\UI\Presenter;

final class TestingPresenter extends Presenter {

	protected function createComponentBox(): Box {
		return new Box();
	}

	protected function createComponentInfobox(): InfoBox {
		return new InfoBox('Testing');
	}

	protected function createComponentSmallbox(): SmallBox {
		return new SmallBox('Testing');
	}

	protected function createComponentTabsbox(): TabsBox {
		$box = new TabsBox();
		$box->addTab('testing', 'Testing');

		return $box;
	}
}