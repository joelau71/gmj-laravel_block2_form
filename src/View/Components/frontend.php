<?php

namespace GMJ\LaravelBlock2Form\View\Components;

use GMJ\LaravelBlock2Form\Models\Block;
use GMJ\LaravelBlock2Form\Models\Config;

use Illuminate\View\Component;

class Frontend extends Component
{
    public $element_id;
    public $page_element_id;
    public $collection;

    public function __construct($pageElementId, $elementId)
    {
        $this->page_element_id = $pageElementId;
        $this->element_id = $elementId;
        $this->collection = Block::with("form")->where("element_id", $elementId)->first();
    }

    public function render()
    {
        $config = Config::where("element_id", $this->element_id)->first();
        $layout = $config->layout;
        return view("LaravelBlock2Form::components.{$layout}.frontend");
    }
}
