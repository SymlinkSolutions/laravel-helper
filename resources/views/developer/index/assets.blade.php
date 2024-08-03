<x-symlink-layouts-dev-layout>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method("post")
        <div class="container-fluid">
            <div class="row">
                <p class="fs-3">General Settings</p>
            </div>
            <div class="row mb-3">
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <h4 class="card-title">Logo</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    
                                </div>
                                <div class="col-12">
                                    {!! Form::idropzone('asset_logo') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </form>

</x-symlink-layouts-dev-layout>
