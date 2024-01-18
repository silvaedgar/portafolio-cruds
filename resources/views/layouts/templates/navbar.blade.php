<div class="navbar">
    {{-- <span>{{ $title }} {{ Auth::user()->name }}</span> --}}
    <span>{{ $title }}
        {{-- {{ isset(auth()->user()->name) == null ? '' : auth()->user()->name }} --}}
    </span>

    <div class="bars">
        <div class="bar">
        </div>
        <div class="bar">
        </div>
        <div class="bar">
        </div>
    </div>
    @auth
        <div class="flex"></div>
        <div class="session" id="session">
            <img src="{{ config('constants.Url') }}{{ auth()->user()->image }}" width="50" id="session" style="border-radius: 50%" />
            {{ auth()->user()->name }} <i class="fa fa-caret-down" aria-hidden="true" id="session"></i>
        @endauth
    </div>
</div>

<div class="menu-session menu-session-hide" style="right: 2px">
    <dl>
        <dt class="link text__color-white"> Mi Perfil </dt>
        <hr style="padding: 0px;">
        <dt class="link-session">

            <form action="{{ route('user.logout') }}" method="POST" id="form-close">
                @csrf
                <a class="link" href="#" onclick="confirmClose()"> Cerrar Sesion </a>
            </form>
        </dt>
    </dl>
</div>
