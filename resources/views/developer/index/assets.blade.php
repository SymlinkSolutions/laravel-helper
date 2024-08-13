<x-symlink-layouts-dev-layout>

    <form action="{{ route('dev.assets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("post")
        <div class="container-fluid">
            <div class="row">
                <p class="fs-3">Project Assets</p>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    {!! Form::submit('Save Changes') !!}
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
                                    <div class="row">
                                        <div class="col-6">
                                            {!! Html::image("assets.logo") !!}
                                        </div>
                                        <div class="col-6">
                                            {!! Form::idropzone('asset_logo', "/asset/logo", [
                                                    "crop" => false,
                                                    "crop_height" => 250,
                                                    "crop_width" => 250,
                                                ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </form>

</x-symlink-layouts-dev-layout>
