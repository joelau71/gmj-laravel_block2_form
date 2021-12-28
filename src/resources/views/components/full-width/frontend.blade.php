<div class="laravel_block2_form" id="laravel_block2_form_{{$element_id}}">
    <x-frontend.row>
        <div>
            {!! $collection->getTranslation("text", $locale) !!}
        </div>
        <form method="POST" id="laravel_block2_form_{{$element_id}}_form" class="mt-6" action="{{ route("form.submit", $collection->form)}}">
            @csrf
            <input type="hidden" name="form_id" value="{{ $collection->form->id }}" />
            @foreach ($collection->form->fields as $field)
                @switch($field->type)
                    @case('text')
                        <div class="mb-4">
                            <div class>
                                <label for="{{ $field->name}}">
                                    {{ $field->getTranslation('label', $locale) }}
                                </label>
                            </div>
                            <input
                                type="text"
                                id="{{ $field->name }}"
                                name="{{ $field->name }}"
                                class="border border-gray-300 rounded-md w-full p-2 focus:outline-none mt-2" />
                            @error($field->name)
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        @break
                    @case('textarea')
                        <div class="mb-4">
                            <div class>
                                <label for="{{ $field->name}}">
                                    {{ $field->getTranslation('label', $locale) }}
                                </label>
                            </div>
                            <textarea
                                id="{{ $field->name }}"
                                name="{{ $field->name }}"
                                cols="30"
                                rows="10"
                                class="border border-gray-300 rounded-md w-full p-2 focus:outline-none mt-2"
                            ></textarea>
                            @error($field->name)
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        @break
                    @case('select')
                        <div class="mb-4">

                            <select
                                name="{{ $field->name }}"
                                id=""
                                class="appearance-none rounded-md w-full p-2 focus:outline-none text-gray-600">
                                <option value="">-- {{ $field->getTranslation("placeholder", $locale) }} --</option>
                                @foreach ($field->options as $option)
                                    <option value="{{ $option->getTranslation("value", $locale) }}">{{ $option->getTranslation("value", $locale) }}</option>
                                @endforeach
                            </select>
                            @error($field->name)
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        @break
                    @default
                        
                @endswitch
            @endforeach
            <div class="w-full mt-4">
                <div class="text-right">
                    <button type="button" id="laravel_block2_form_{{$element_id}}_submit" class="px-6 py-2 cursor-pointer main-btn-bg-color rounded-lg text-white">
                        {{ $collection->form->getTranslation("submit", $locale) }}
                    </button>
                </div>
            </div>
        </form>
    </x-frontend.row>

    @push("js")
        @once
            <script>
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                    }
                });
            </script>
        @endonce
        @if ($collection->form->google_recaptcha_v3_active && $setting->recaptchav3_sitekey && $setting->recaptchav3_secret)
        <script>
            $("#laravel_block2_form_{{$element_id}}_submit").on("click", function() {
                $(this).off();
                const $form = $("#laravel_block2_form_{{$element_id}}_form");
                grecaptcha.ready(function() {
                    grecaptcha.execute("{{$setting->recaptchav3_sitekey}}", {action: 'join'}).then(function(token) {
                        $form.prepend('<input type="hidden" name="token" value="' + token + '">');
                        $form.submit();
                    });;
                });
                return false;
            });
        </script>
    @else
        <script>
            $("#laravel_block2_form_{{$element_id}}_submit").on("click", function() {
                $(this).off();
                const $form = $("#laravel_block2_form_{{$element_id}}_form");
                $form.submit();
            });
        </script>
    @endif
    @endpush
</div>
