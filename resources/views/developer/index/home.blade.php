<x-symlink-layouts-dev-layout>

    <form action="" method="POST">
        @csrf
        @method('post')

        <div class="container-fluid">
            <div class="row">
                <p class="fs-3">General Settings</p>
            </div>
            <div class="row">
                <div class="col-auto">
                    {!! Form::submit('Save Changes') !!}
                </div>
                <div class="col-auto">
                    {!! Html::button('Update Styles', route('dev.update.styles'), [
                        '.btn-warning' => true,
                    ]) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-4">

                    {!! Form::itext('app_name', 'App Name', $app_name) !!}
                    {!! Form::itext('primary_font_family', 'Primary Font Family', $primary_font_family) !!}
                    {!! Form::itextarea('font_primary', 'Font Primary', $font_primary) !!}
                    {!! Form::itext('secondary_font_family', 'Secondary Font Family', $secondary_font_family) !!}
                    {!! Form::itextarea('font_secondary', 'Font Secondary', $font_secondary) !!}
                    

                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <h4 class="card-title">Bootstrap Colors</h4>
                                </div>
                                <div class="col-auto">
                                    {!! Html::button('Reset Colors', route('dev.reset.colors'), [
                                        '.btn-secondary' => true,
                                    ]) !!}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                {!! Form::icolorpicker('bs_primary', 'Primary', $bs_primary, []) !!}
                                {!! Form::icolorpicker('bs_secondary', 'Secondary', $bs_secondary, []) !!}
                                {!! Form::icolorpicker('bs_success', 'Success', $bs_success, []) !!}
                                {!! Form::icolorpicker('bs_danger', 'Danger', $bs_danger, []) !!}
                                {!! Form::icolorpicker('bs_warning', 'Warning', $bs_warning, []) !!}
                                {!! Form::icolorpicker('bs_info', 'info', $bs_info, []) !!}
                                {!! Form::icolorpicker('bs_light', 'light', $bs_light, []) !!}
                                {!! Form::icolorpicker('bs_dark', 'dark', $bs_dark, []) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </form>

</x-symlink-layouts-dev-layout>
