<?php declare(strict_types = 1);

namespace Netlte\Boxes\Tests\Cases\Unit;

use Netlte\Boxes\InfoBox;
use Netlte\Boxes\Tests\Helpers\PresenterFactory;
use Netlte\Boxes\Tests\Helpers\TestingTemplateFactory;
use Nette\ArgumentOutOfRangeException;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class InfoBoxTest extends TestCase {

	/** @var InfoBox|IComponent|null */
	private $box;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->box = $presenter->getComponent('infobox');
	}

	public function testRender(): void {
		/** @var InfoBox $box */
		$box = $this->box;

		$box->setTemplateFactory(new TestingTemplateFactory());

		\ob_start();
		$box->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);
	}

	public function testProgress(): void {
		/** @var InfoBox $box */
		$box = $this->box;

		// Greater than max
		$f_max = function() use($box): void {
			$box->setProgress(110);
		};

		// Lower than min
		$f_min = function() use($box): void {
			$box->setProgress(-10);
		};

		// in range
		$f_ok = function() use($box): void {
			$box->setProgress(57);
		};

		Assert::exception($f_max, ArgumentOutOfRangeException::class);
		Assert::exception($f_min, ArgumentOutOfRangeException::class);
		Assert::error($f_ok, []);

	}

}

(new InfoBoxTest())->run();