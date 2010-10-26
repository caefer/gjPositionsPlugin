<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormInput represents an HTML text input tag.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormInputText.class.php 30762 2010-08-25 12:33:33Z fabien $
 */
class sfWidgetFormInputArray extends sfWidgetFormInputText
{
  /**
   * Configures the current widget.
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addRequiredOption('config');

    $this->setOption('is_hidden', empty($options['config']));
  }

  /**
   * Renders the widget.
   *
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if(0 == count($this->getOption('config')))
    {
      return '';
    }

    if(is_null($value)) $value = array();

    $output = array();
    foreach($this->getOption('config') as $field => $config)
    {
      if(in_array($config['type'], array('checkbox', 'radio')))
      {
        $attributes['checked'] = 'checked';
      }

      $output[] = $this->renderContentTag('label', sfInflector::humanize($field)).PHP_EOL.
                  $this->renderTag('input', array_merge(array(
                    'type'  => $config['type'],
                    'name'  => $name.'['.$field.']',
                    'value' => array_key_exists($field, $value) ? $value[$field] : $config['default']
                  ), $attributes));
    }

    return '<fieldset>'.implode("<br />\n", $output).'</fieldset>';
  }
}
