<?php declare(strict_types = 1);

namespace Netlte\Boxes\Tests\Cases\Unit;

use Netlte\Boxes\Box;
use Netlte\Boxes\Tests\Helpers\PresenterFactory;
use Netlte\Boxes\Tests\Helpers\TestingTemplateFactory;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class BoxTest extends TestCase {

	/** @var Box|IComponent|null */
	private $box;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->box = $presenter->getComponent('box');
	}

	public function testRender(): void {
		/** @var Box $box */
		$box = $this->box;

		$box->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$box->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

	public function testTools(): void {
		/** @var Box $box */
		$box = $this->box;

		// Custom tool
		$box->addTool('test', 'plus');
		Assert::true($box->hasTools());
		$box->removeTool('test');
		Assert::false($box->hasTools());

		// Collapsable
		$box->setCollapsable(true);
		Assert::true($box->hasTools());
		$box->setCollapsable(false);
		Assert::false($box->hasTools());

		// Collapsed - if set box as collapsed than must be collapsable
		$box->setCollapsed(true);
		Assert::true($box->hasTools());
		Assert::true($box->isCollapsable());
		Assert::true($box->isCollapsed());
		$box->setCollapsed(false);
		$box->setCollapsable(false);
		Assert::false($box->hasTools());

		// Removable
		$box->setRemovable(true);
		Assert::true($box->hasTools());
		Assert::true($box->isRemovable());
		$box->setRemovable(false);
		Assert::false($box->hasTools());

        // Maximizable
        $box->setMaximizable(true);
        Assert::true($box->hasTools());
        Assert::true($box->isMaximizable());
        $box->setMaximizable(false);
        Assert::false($box->hasTools());

        // Refreshable
        $box->setRefreshUrl('some-url');
        Assert::true($box->hasTools());
        Assert::true($box->isRefreshable());
        $box->setRefreshUrl(null);
        Assert::false($box->hasTools());

	}

}

(new BoxTest())->run();