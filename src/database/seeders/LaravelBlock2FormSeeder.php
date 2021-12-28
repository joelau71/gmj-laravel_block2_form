<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\ElementTemplate;
use Faker\Factory;
use GMJ\LaravelBlock2Form\Models\Block;
use GMJ\LaravelBlock2Form\Models\Config;
use Illuminate\Database\Seeder;

class LaravelBlock2FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ElementTemplate::where("component", "LaravelBlock2Form")->first();

        if ($template) {
            return false;
        }

        $template = ElementTemplate::create(
            [
                "title" => "Laravel Block2 Form",
                "component" => "LaravelBlock2Form",
            ]
        );

        $element = Element::create([
            "template_id" => $template->id,
            "title" => "laravel-block2-form-sample",
            "is_active" => 1
        ]);

        $faker = Factory::create();

        Config::create([
            "element_id" => $element->id,
            "layout" => "full-width"
        ]);

        foreach (config('translatable.locales') as $locale) {
            $text[$locale] = $faker->text(100);
        }

        Block::create([
            "element_id" => $element->id,
            "form_id" => 1,
            "text" => $text
        ]);
    }
}
