<x-symlink-layouts-auth-layout>

    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="card col-12 col-md-6 col-lg-5 p-0">
            <div class="row g-0">
                <div class="col-5 d-none d-md-block">
                    <img src="{{ asset('images/illustrations/login.svg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-md-7">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4">Login</h3>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            @method('post')

                            {!! Form::itext("email", "Email") !!}

                            {!! Form::itext("password", "Password", false, [
                                "hidden" => true
                            ]) !!}

                            {!! Form::icheckbox("remember_me", "Rememener Me!") !!}

                            <div class="d-grid gap-2">
                                {!! Form::submit("Login", ["class" => "btn btn-primary"]) !!}

                                <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register With Email</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-symlink-layouts-auth-layout>

