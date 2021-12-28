<?php

namespace GMJ\LaravelBlock2Form\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use App\Models\Form;
use GMJ\LaravelBlock2Form\Models\Block;
use GMJ\LaravelBlock2Form\Models\Config;

class BlockController extends Controller
{
    public function index($element_id)
    {
        $config = Config::where("element_id", $element_id)->first();
        if (!$config) {
            return redirect()->route("LaravelBlock2Form.config.create", $element_id);
        }

        $collection = Block::where("element_id", $element_id)->first();
        if ($collection) {
            return redirect()->route("LaravelBlock2Form.edit", $element_id);
        }
        return redirect()->route("LaravelBlock2Form.create", $element_id);
    }

    public function create($element_id)
    {
        $element = Element::findOrFail($element_id);
        $forms = Form::all();
        return view("LaravelBlock2Form::create", compact("element", "element_id", "forms"));
    }

    public function store($element_id)
    {
        $element = Element::findOrFail($element_id);

        foreach (config("translatable.locales") as $lang) {
            $text[$lang] = request()["text_{$lang}"];
        }

        $collection = new Block();
        $collection->element_id = $element_id;
        $collection->form_id = request()->form_id;
        $collection->text = $text;
        $collection->save();

        $element->active();
        Alert::success("Add Element {$element->title} Form success", 'success');
        return redirect()->route("admin.element.index");
    }

    public function edit($element_id)
    {
        $element = Element::find($element_id);
        $collection = Block::where("element_id", $element_id)->first();
        $forms = Form::all();
        return view("LaravelBlock2Form::edit", compact("element", "element_id", "collection", "forms"));
    }

    public function update($element_id)
    {
        $element = Element::findOrFail($element_id);

        foreach (config("translatable.locales") as $lang) {
            $text[$lang] = request()["text_{$lang}"];
        }

        $collection = Block::where("element_id", $element_id)->first();
        $collection->form_id = request()->form_id;
        $collection->text = $text;
        $collection->save();

        Alert::success("Edit Element {$element->slug} Form success");
        return redirect()->route("admin.element.index");
    }
}
