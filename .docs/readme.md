# Netlte > Boxes

## Install

```
composer require netlte/boxes
```

## Tests

Check code quality and run tests
```
composer build
```

or separately

```
composer cs
composer analyse
composer tests
```

## Usage

### Template
Default templates supports `Nette\Localization\Translator` for translating captions and can be overridden for global scope by changing static template path in `\Netlte\Boxes\<COMPONENT_NAME>::$DEFAULT_TEMPLATE` or dynamically in runtime by
```php
/** @var \Netlte\UI\AbstractControl $control */
$control->setTemplateFile('/path/to/yours/template.latte');
```

### Box
Box is universal wrapper. You can set title, tools, color, border etc. To insert body you have to just add `\Nette\ComponentModel\IComponent` just like in other Controls.

#### Properties

* **tools** - buttons in box header (Collapse/minimize and remove are predefined by setters) 
* **title** - Box header title
* **background** - Background or box color
* **solid** - Set box header solid. If box is solid then header have background color.
* **collapsed** - Set box collapsed/minimized as default (**This option set box collapsable!**)
* **collapsable** - Add tool to header for minimizing box
* **removable** - Add tool to header for remove box
* **overlay** - Disable/Enable overlay with animation. Good option if you have some kind of lazy(AJAX for example) loading of box content
* **padding** - Disable/Enable box's body padding
* **border** - Disable/Enable border under the box's header

#### Example
```php
<?php
/** @var Nette\Application\UI\Presenter $presenter */

$html = \Nette\Utils\Html::el('')->setText('The body of the box');
$content = new \Netlte\UI\HtmlControl($html);

$removable = new \Netlte\Boxes\Box('Removable');
$removable
    ->setBackground('success')
    ->setRemovable(true)
    ->addComponent(clone $content, 'body');
    
// Add tool to box and reaction on click
$removable->addTool('calendar', 'calendar')
    ->setAjax(true)
    ->onClick[] = function() use ($presenter) {
        $presenter->redirect('Calendar:default');
    };
```
![Box screenshot](.docs/box.png)

### SmallBox
By `Netlte\Boxes\SmallBox` you can show to users some kind of info data like number of orders.

#### Properties

* **text** - Describing what box showing
* **icon** - Graphical representation of shown data
* **background** - Background or box color
* **header** - Header text
* **link** - If you set link then "View more" button in footer appear. Link is string in Nette structure.
* **smaller** - Disable/Enable smaller size of box

#### Example
```php
<?php

$orders = new \Netlte\Boxes\SmallBox(
			'New Orders', // Text
			'md-basket', // Icon
			'aqua', // Background
			'150', // Header text
			'this' // Link
		);
```
![SmallBox screenshot](.docs/smallbox.png)

### InfoBox
By `Netlte\Boxes\InfoBox` you can show to users some kind of numeric data like number of likes and their progress.

#### Properties

* **text** - Title of box
* **icon** - Graphical representation of showed data
* **background** - Background or box color
* **value** - Float data value
* **progress** - Float value from 0 to 100 describing progress
* **description** - Description of showed data

#### Example
```php
<?php

$likes = new \Netlte\Boxes\InfoBox(
			'LIKES', // Text
			'ios-thumbs-up-outline', // Icon
			'green', // Background
			41410, // Value
			70, // Progress
			'70% Increase i 30 Days' // Description
		);
```
![InfoBox screenshot](.docs/infobox.png)

### TabsBox
`Netlte\Boxes\TabsBox` is similar to `Netlte\Boxes\Box`. You can define content by adding controls but sorted in tabs!
You can add Tab by `addTab()` method or `addComponent()` method but by default template only components implementing `Netlte\Boxes\ITab` are shown.
`Netlte\Boxes\Tab` created by `addTab()` method are standard control. So you can add Component inside them as tab content.

#### Properties

* **active** - You can set any tab as active by name

#### Example
```php
<?php

$donut_html = Nette\Utils\Html::el('p')->setText('Donut graph'); 
$area_html = Nette\Utils\Html::el('p')->setText('Area graph'); 

$donut_content = new Netlte\UI\HtmlControl($donut_html);
$area_content = new Netlte\UI\HtmlControl($area_html);

$sales = new Netlte\Boxes\TabsBox();
// addTab(string $name, string $label)
$sales->addTab('donut', 'Donut')->addComponent($donut_content, 'content');
$sales->addTab('area', 'Area')->addComponent($area_content, 'content');
```
![TabsBox screenshot](.docs/tabsbox.png)

## Development

More examples are in [tests](../tests/) or in [sandbox](https://github.com/Netlte/Sandbox) project app.
