<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * TypeAhead renders a typehead bootstrap javascript component.
 *
 * For example,
 *
 * ```php
 * echo TypeAhead::widget(array(
 *     'form' => $form,
 *     'model' => $model,
 *     'attribute' => 'country',
 *     'pluginOptions' => array(
 *         'source' => array('USA', 'ESP'),
 *     ),
 * ));
 * ```
 *
 * The following example will use the name property instead
 *
 * ```php
 * echo TypeAhead::widget(array(
 *     'name'  => 'country',
 *     'pluginOptions' => array(
 *         'source' => array('USA', 'ESP'),
 *     ),
 * ));
 *```
 *
 * @see http://twitter.github.io/bootstrap/javascript.html#typeahead
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @since 2.0
 */
class TypeAhead extends Widget
{
	/**
	 * @var \yii\base\Model the data model that this field is associated with
	 */
	public $model;
	/**
	 * @var string the model attribute that this field is associated with
	 */
	public $attribute;

	/**
	 * @var string the input name. This must be set if [[form]] is not set.
	 */
	public $name;

	/**
	 * Renders the widget
	 */
	public function run()
	{
		echo "\n" . $this->renderField() . "\n";
		$this->registerPlugin('typeahead');
	}

	/**
	 * Renders the TypeAhead field. If [[model]] has been specified then it will render an active field.
	 * If [[model]] is null or not from an [[Model]] instance, then the field will be rendered according to
	 * the [[name]] attribute.
	 * @return string the rendering result
	 * @throws InvalidParamException when none of the required attributes are set to render the textInput. That is,
	 * if [[model]] and [[attribute]] are not set, then [[name]] is required.
	 */
	public function renderField()
	{
		if ($this->model instanceof Model && $this->attribute !== null) {

			$this->options['id'] = $this->id = Html::getInputId($this->model, $this->attribute);

			return Html::activeTextInput($this->model, $this->attribute, $this->options);
		}

		if ($this->name === null) {
			throw new InvalidParamException(
				get_class($this) . ' must specify "form", "model" and "attribute" or "name" property values'
			);
		}

		return Html::textInput($this->name, '', $this->options);
	}
}
