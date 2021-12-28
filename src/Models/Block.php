<?php

namespace GMJ\LaravelBlock2Form\Models;

use App\Models\Form;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Block extends Model
{
    use HasTranslations;

    protected $guarded = [];
    protected $table = "laravel_block2_forms";
    public $translatable = ['text'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
