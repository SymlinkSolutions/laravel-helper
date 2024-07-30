<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="collapsibleNavId">

            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#" aria-current="page">Setup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Action 1</a>
                        <a class="dropdown-item" href="#">Action 2</a>
                    </div>
                </li>
            </ul>

            <div>
                <a href="{{ route('home') }}" class="btn btn-outline-warning" target="_blank">Website</a>
                <a href="{{ route('home') }}" class="btn btn-outline-warning" target="_blank">System</a>
            </div>

        </div>
    </div>
</nav>
