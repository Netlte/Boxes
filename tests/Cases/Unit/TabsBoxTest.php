<?php declare(strict_types = 1);

namespace Netlte\Boxes\Tests\Cases\Unit;

use Netlte\Boxes\ITab;
use Netlte\Boxes\TabsBox;
use Netlte\Boxes\Tests\Helpers\PresenterFactory;
use Netlte\Boxes\Tests\Helpers\TestingTemplate;
use Netlte\Boxes\Tests\Helpers\TestingTemplateFactory;
use Netlte\UI\AbstractControl;
use Nette\Application\UI\Control;
use Nette\Application\UI\Template;
use Nette\Application\UI\TemplateFactory;
use Nette\ComponentModel\IComponent;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../bootstrap.php';

class TabsBoxTest extends TestCase {

	/** @var TabsBox|IComponent|null */
	private $box;

	public function setUp(): void {
		$factory = new PresenterFactory();
		$presenter = $factory->create();
		$this->box = $presenter->getComponent('tabsbox');
	}

	public function testRender(): void {
		/** @var TabsBox $box */
		$box = $this->box;

		$component = new class extends AbstractControl {
			public function render(): void {
				echo 'Template';
			}
		};

		$box->setTemplateFactory(self::templateFactory());
		/** @var ITab $tab */
		$tab = $box->getTab('testing');

		Assert::type(ITab::class, $tab);

		$tab->addComponent($component, 'subcontrol');

		\ob_start();
		$box->render();
		$result = \ob_get_clean();

		Assert::equal('TestingTemplate', $result);

		$tab->removeComponent($tab->getComponent('subcontrol'));

		\ob_start();
		$box->render();
		$result = \ob_get_clean();

		Assert::equal('Testing', $result);
	}

	static protected function templateFactory(): TemplateFactory {
		return new class extends TestingTemplateFactory {

			public function createTemplate(?Control $control = null): Template {
				return new class($control) extends TestingTemplate {

					public function render(): void {
						echo "Testing";

						if ($this->control === null) return;

						/** @var ITab[] $tabs */
						$tabs = $this->control->getComponents(false, \Netlte\Boxes\ITab::class) ;
						foreach ($tabs as $tab) {
							$tab->render();
						};
					}
				};
			}
		};
	}

}

(new TabsBoxTest())->run();