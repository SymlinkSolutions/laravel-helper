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
            </div>
            <div class="row">
                <div class="col-4">

                    {!! Form::itext("app_name", "App Name", $app_name) !!}

                </div>
            </div>
        </div>

    </form>
    
</x-symlink-layouts-dev-layout>