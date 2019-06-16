<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Elements;

class Opening extends BaseElement
{
    protected $template = "open";

    /**
     * Allows setting wrap to false at the form level from the $form->open() tag
     * 
     * @param  bool  $bool
     *
     * @return Opening
     */
    public function nowrap(bool $bool = true): self
    {
        $this->form->wrap = !$bool;
        
        return $this;
    }
}
