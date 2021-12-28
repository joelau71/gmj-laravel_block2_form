<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Form"],
        ['name' => "Create"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <div>
        <form id="myform" method="POST"
            action="{{ route('LaravelBlock2Form.store', $element_id) }}" class="relative" enctype="multipart/form-data">

            <x-admin.atoms.required />

            @csrf

            @foreach (config('translatable.locales') as $locale)
                <x-admin.atoms.row>
                    <x-admin.atoms.label for="text_{{ $locale }}">
                        Content({{ $locale }})
                    </x-admin.atoms.label>
                    <textarea name="text_{{ $locale }}" id="text_{{ $locale }}" class="tinymce-textarea" style="height: 200px;"></textarea>
                </x-admin.atoms.row>
            @endforeach

            <x-admin.atoms.row>
                <x-admin.atoms.label for="form_id" class="required">
                    Form
                </x-admin.atoms.label>
                <x-admin.atoms.select name="form_id" id="form_id">
                    @foreach ($forms as $form)
                        <option value="{{ $form->id }}">{{ $form->slug }}</option>
                    @endforeach
                </x-admin.atoms.select>
                @error("form_id")
                    <x-admin.atoms.error>
                        {{ $message }}
                    </x-admin.atoms.error>
                @enderror
            </x-admin.atoms.row>
            
            <hr class="my-10">

            <div class="mt-4 text-right">
                <x-admin.atoms.link href="{{ url()->previous() }}">Back</x-admin.atoms.link>
                <x-admin.atoms.button class="ml-3" id="save">Save</x-admin.atoms.button>
            </div>
        </form>
    </div>
</x-admin.layout.app>