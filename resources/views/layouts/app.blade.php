<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('css')

    @yield('extra-css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styles-content.css">
    <link rel="stylesheet" href="css/styles-table.css">

    <link rel="icon" type="image/png" href="{{ env('APP_IMAGE') }}/profile-img.jpg">
    <title>{{ env('APP_NAME') }}</title>

</head>

<body onload="checkSize()">
    {{-- @auth() --}}
    {{-- action="{{ route('logout') }}" --}}
    <form id="logout-form" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.templates.sidebar')
    {{-- @endauth
    @guest()
    @include('layouts.page_templates.guest')
    @endguest --}}


    <script>
        var changeSize = false;

        window.addEventListener('resize', (e) => {
            checkSize()
        })

        window.addEventListener('click', (e) => {
            if (e.target.id.includes('-sublevel') || e.target.id.includes('-caret')) processMenuLevel(e)
            else {
                if (e.target.id == "session") {
                    var menu = document.querySelector(".menu-session");
                    menu.classList.toggle("menu-session-hide")
                } else {
                    if (window.innerWidth <= 800 && (e.target.parentElement.className == "bars" || e.target
                            .className ==
                            "bars" || e.clientX >= 235)) {
                        if (e.clientX >= 235) {
                            if (!getClassSidebar()) mostrarSideBar()
                            if (!getClassMenuSession()) mostrarMenuSession()

                        } else mostrarSideBar()
                    } else {
                        if (!getClassMenuSession()) mostrarMenuSession()

                    }
                }
            }
        })

        function getClassSidebar() {
            let modes = document.querySelector(".sidebar");
            return modes.classList.contains('sidebar-hide')
        }

        function getClassMenuSession() {
            let menus = document.querySelector(".menu-session");
            return menus.classList.contains('menu-session-hide')
        }

        function checkSize() {
            if (window.innerWidth <= 800) {
                if (!changeSize)
                    mostrarSideBar()
                changeSize = true
            } else {
                if (window.innerWidth > 800) {
                    if (getClassSidebar()) mostrarSideBar()
                }
                changeSize = false;
            }
        }

        function mostrarSideBar() {
            var modes = document.querySelector(".sidebar");
            modes.classList.toggle("sidebar-hide")
            let bars = document.querySelector(".bars");
            if (modes.classList.contains("sidebar-hide")) {
                bars.style.margin = "0px 0px 0px 5px"
            } else bars.style.margin = "0px 0px 0px 150px"
        }

        function mostrarMenuSession() {
            var modes = document.querySelector(".menu-session");
            modes.classList.toggle("menu-session-hide")
        }

        function processMenuLevel(e) {
            let arraySubLevel = e.target.id.split("-");
            let menuSubLevel = arraySubLevel[0]
            document.getElementById(menuSubLevel).classList.toggle("nav-link-hidden")
            if (document.getElementById(menuSubLevel).classList.contains('nav-link-hidden')) {
                // document.getElementById(menuSubLevel + "-caret").style.transform = "rotate(0deg)"
                document.getElementById(menuSubLevel + "-caret").classList.remove("caret-rotate")
                document.getElementById(menuSubLevel + "-caret").classList.add("caret")

            } else {
                // document.getElementById(menuSubLevel + "-caret").style.transform = "rotate(180deg)"
                document.getElementById(menuSubLevel + "-caret").classList.remove("caret")
                document.getElementById(menuSubLevel + "-caret").classList.add("caret-rotate")
            }
        }

        function confirmClose() {
            event.preventDefault();
            if (confirm("Seguro de Cerrar la Sesion"))
                document.getElementById('form-close').submit();
        }
    </script>
    @stack('js')

    @stack('extrajs')

</body>

</html>
