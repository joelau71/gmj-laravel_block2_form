<?php

namespace GMJ\LaravelBlock2Form\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelBlock2Form\Models\Config;

class ConfigController extends Controller
{
    public function create($element_id)
    {
        $element = Element::findOrFail($element_id);
        return view("LaravelBlock2FormConfig::create", compact("element", "element_id"));
    }

    public function store($element_id)
    {

        request()->validate([
            "layout" => "required",
        ]);

        $element = Element::findOrFail($element_id);

        $collection = new Config();
        $collection->element_id = $element_id;
        $collection->layout = request()->layout;
        $collection->save();

        $element->active();
        Alert::success("Add Element {$element->title} Form Config success");
        return redirect()->route("LaravelBlock2Form.create", $element_id);
    }

    public function edit($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Config::where("element_id", $element_id)->first();
        return view("LaravelBlock2FormConfig::edit", compact("element", "element_id", "collection"));
    }

    public function update($element_id)
    {

        request()->validate([
            "layout" => "required",
        ]);

        $element = Element::findOrFail($element_id);

        $collection = Config::where("element_id", $element_id)->first();
        $collection->layout = request()->layout;
        $collection->save();

        Alert::success("Edit Element {$element->title} Form Config success");
        return redirect()->route("LaravelBlock2Form.edit", $element_id);
    }
}
