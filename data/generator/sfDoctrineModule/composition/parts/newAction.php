  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();

    if($this->getUser()->hasFlash('preview_form_values'))
    {
      $this->form->bind($this->getUser()->getFlash('preview_form_values'));
    }

    $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();
  }
