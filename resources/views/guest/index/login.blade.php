<x-symlink-layouts-guest-layout>


    <div class="container-fluid vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card">
                    
                    <div class="row">
                        <div class="col-5 p-3 d-flex align-items-center justify-content-center">
                            {!! Html::image() !!}
                        </div>
                        <div class="col-7 p-3">
                            <div class="row">
                                <p class="fs-4">Login</p>
                            </div>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                @method('post')
                                
                                {!! Form::itext("email", "Email") !!}

                                {!! Form::itext("password", "Password", false, [
                                    "hidden" => true
                                ]) !!}

                                {!! Form::itext("password_confirmation", "Confirm Password", false, [
                                    "hidden" => true
                                ]) !!}

                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::submit("Login") !!}
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100">Register With Email</a>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-symlink-layouts-guest-layout>
