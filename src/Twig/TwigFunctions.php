<?php

namespace Oz\Bs4Crud\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFunction;

class TwigFunctions extends AbstractExtension
{


    public function getFunctions()
    {
        return [
            new TwigFunction('yesNo', [$this, 'yesNoHtml']),
            new TwigFunction('yes', [$this, 'yesHtml']),
            new TwigFunction('no', [$this, 'noHtml']),
            new TwigFunction('bs4_switch', [$this, 'bs4_switch']),
        ];
    }

    /**
     * @param boolean $value
     * @return Markup
     */
    public function yesNoHtml(bool $value)
    {
        return $value ? $this->yesHtml() : $this->noHtml();
    }


    /**
     * @return Markup
     */
    public function yesHtml()
    {
        $code = '<span class="badge badge-pill badge-success">Oui</span>';
        return new Markup($code, "utf-8");
    }

    /**
     * @return Markup
     */
    public function noHtml()
    {
        $code = '<span class="badge badge-pill badge-danger">Non</span>';
        return new Markup($code, "utf-8");
    }

    /**
     * @param $fieldName
     * @param $value
     * @param $entityId
     * @return Markup
     */
    public function bs4_switch($fieldName, $value, $entityId)
    {
        $html    = <<<HTML
<div class="custom-control custom-switch oz-bs4-crud-switch">
  <input %s type="checkbox" class="custom-control-input" id="switch_$entityId" data-entity="$entityId" data-fieldname="$fieldName">
  <label class="custom-control-label" for="switch_$entityId"></label>
</div>
HTML;
        $checked = $value ? 'checked' : '';
        return new Markup(sprintf($html, $checked), "utf-8");
    }
}