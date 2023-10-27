<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>eLEARNING</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between  id="navbarCollapse">
        <div class="navbar-nav  ms-auto p-4 p-lg-0">
            <div class="d-flex">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="{{ route('Courses.index') }}" class="nav-item nav-link">Courses</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
        </div>


        @guest
        <div class="p-2"> <a href="{{ route('loginFront') }}" class="btn btn-primary  py-4 px-lg-5 d-none d-lg-block">Join Now<i
            class="fa fa-arrow-right  ms-3"></i></a></div>

    @endguest
        @auth
            <!-- Navbar -->

            <div class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fas fa-user"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <div class="dropdown-menu dropdown-menu-right fade-down" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('My profile') }}</a>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit profile') }}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"

                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
            </div>
        @endauth
</nav>
<!-- End Navbar -->


</div>
{{-- @auth --}}

</div>
</nav>
<!-- Navbar End -->
