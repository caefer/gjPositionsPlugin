<?php

class sfWidgetFormSchemaFormatterPositions extends sfWidgetFormSchemaFormatterList
{
  protected
    $rowFormat       = "<li>\n  %error%\n  %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<br />%help%',
    $decoratorFormat = "<ol class=\"positions_container\">\n  %content%</ol>";
}
