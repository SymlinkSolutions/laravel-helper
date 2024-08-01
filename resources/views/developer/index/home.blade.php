<x-symlink-layouts-dev-layout>
    
    <form action="" method="POST">
        @csrf
        @method("post")

        <div class="container-fluid">
            <div class="row">
                <p class="fs-3">General Settings</p>
            </div>
            <div class="row">
                <div class="col-auto">
                    {!! Form::submit("Save Changes") !!}
                </div>
                <div class="col-auto">
                    {!! Html::button("Update Styles", route('dev.update.styles'), [
                        ".btn-warning" => true
                    ]) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-4">

                    {!! Form::itext("app_name", "App Name", $app_name) !!}
                    {!! Form::itext("primary_font_family", "Primary Font Family", $primary_font_family) !!}
                    {!! Form::itextarea("font_primary", "Font Primary", $font_primary) !!}
                    {!! Form::itext("secondary_font_family", "Secondary Font Family", $secondary_font_family) !!}
                    {!! Form::itextarea("font_secondary", "Font Secondary", $font_secondary) !!}

                </div>
            </div>
        </div>

    </form>
    
</x-symlink-layouts-dev-layout>