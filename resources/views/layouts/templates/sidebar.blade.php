@include('layouts.templates.navbar')

<div class="sidebar">
    <div class="sidebar-header">
        <h4 style="font-size: 15px; font-weight: bold"> {{ env('APP_NAME') }} </h4>
        <img src="{{ 'images/profile-img.jpg' }}" width="50" style="border-radius: 45%">
    </div>

    @foreach (config('menu.options') as $item)

        @php
            $needAuth = true;
            $isLogged = isset(Auth::user()->name);
            if (!$isLogged) {
                $needAuth = $item['auth'];
            }
        @endphp
        @if (!$needAuth || $isLogged)
            <div class="nav-link {{ strtolower($item['label']) == strtolower($activePage) ? 'link-select' : '' }} ">
                <!-- verfica si es el link selecciondado y asigna el id para el JS del menu -->
                @if (VerifyPermissionsFacade::checkPermissions(config($item['permissions'])))
                    <a class="link text__color-white" {{ $item['url'] != '' ? 'href=' . route($item['url']) : '' }}
                        {{ $item['id'] ? 'id=' . $item['id'] . '-sublevel' : '' }}>
                        <!-- Ejecutar icono para ser mostrado y muestra la etiqueta -->
                        {!! $item['icon'] !!}
                        {{ $item['label'] }}
                        <!-- ¿posee niveles? -->
                        @if ($item['caret'])
                            <i class="fa fa-caret-down {{ strtolower($item['id']) == strtolower($collapse) ? 'caret-rotate' : 'caret' }}"
                                aria-hidden="true" id={{ $item['id'] . '-caret' }}></i>
                        @endif
                    </a>
                @endif
            </div>

            @if ($item['caret'])
                <div class="nav-link bg__color-white {{ strtolower($collapse) == strtolower($item['id']) ? '' : 'nav-link-hidden' }} "
                    id={{ $item['id'] }} style="margin-top: -10px">
                    @foreach ($item['caret'] as $subItem)
                        @if (VerifyPermissionsFacade::checkPermissions(config($subItem['permissions'])))
                            <a class="link pl-2 {{ strtolower($subItem['label']) == strtolower($activePage) ? 'link-select' : 'text__color-black' }} "
                                {{ $subItem['url'] != '' ? 'href=' . route($subItem['url']) : '' }}>
                                {!! $subItem['icon'] !!}
                                {{ $subItem['label'] }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        @endif
    @endforeach

</div>

@yield('content')
