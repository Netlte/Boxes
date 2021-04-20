<?php declare(strict_types = 1);

namespace Netlte\Boxes\Tests\Cases\Unit;

use Netlte\Boxes\SmallBox;
use Netlte\Boxes\Tests\Helpers\PresenterFactory;
use Netlte\Boxes\Tests\Helpers\TestingTemplateFactory;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class SmallBoxTest extends TestCase {

	/** @var SmallBox|IComponent|null */
	private $box;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->box = $presenter->getComponent('smallbox');
	}

	public function testRender(): void {
		/** @var SmallBox $box */
		$box = $this->box;

		$box->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$box->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

}

(new SmallBoxTest())->run();