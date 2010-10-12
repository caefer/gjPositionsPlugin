<?php

class gjWidgetFormSchemaFormatterDesignElement extends sfWidgetFormSchemaFormatterList
{
  protected
    $rowFormat       = "<div>\n  %error%%label%\n  %field%%help%\n%hidden_fields%</div>\n",
    $errorRowFormat  = "<p>\n%errors%</p>\n",
    $helpFormat      = '<br />%help%',
    $decoratorFormat = "<div id=\"design_element_items\">\n  %content%</div>";
}
