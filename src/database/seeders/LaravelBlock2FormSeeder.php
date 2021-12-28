<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\ElementTemplate;
use App\Models\Form;
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
            $message[$locale] = $faker->text(50);
            $submit[$locale] = $faker->text(10);
        }

        $form = Form::create([
            "slug" => "laravel-block2-form-sample",
            "message" => $message,
            "submit" => $submit,
            "google_recaptcha_v3_active" => 1
        ]);

        foreach (range(0, 5) as $key => $item) {

            foreach (config('translatable.locales') as $locale) {
                $label[$locale] = $faker->text(10);
                $placeholder[$locale] = $faker->text(10);
            }

            $form->fields()->create([
                "name" => $faker->sentence,
                "column" => 12,
                "type" => "text",
                "label" => $label,
                "placeholder" => $placeholder,
                "is_required" => 1,
                "display_order" => $key
            ]);
        }

        foreach (config('translatable.locales') as $locale) {
            $text[$locale] = $faker->text(100);
        }

        Block::create([
            "element_id" => $element->id,
            "form_id" => $form->id,
            "text" => $text
        ]);
    }
}
