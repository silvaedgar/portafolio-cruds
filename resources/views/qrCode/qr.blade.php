@extends ('layouts.app', ['activePage' => config('labelsMenu.qrView.label'), 'collapse' =>
config('labelsMenu.qrView.collapse'), 'title' => config('labelsMenu.qrView.title')])

@section('css')
<style>
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
    }

    .container-form {
        width: 50%;
    }

    .container-qr {
        width: 50%;
        display: flex;
        flex-direction: column;
    }

    .form {
        display: block;
        background-color: var(--color-primary);
        box-shadow: 8px 5px 15px -8px rgba(15, 15, 15, 1);
        width: 70%;
        margin: 0 auto;
        padding: 1px;
        text-align: center;
    }

    .qr {
        display: flex;
        flex-direction: column;
        width: 300px;
        max-height: 35vh;
        background-color: var(--color-primary);
        box-shadow: 8px 5px 15px -8px rgba(15, 15, 15, 1);
        margin: 10px auto;
        align-items: center;
        /* padding: 15px 0px; */
    }

    .qr h3 {
        margin - top: 15px;
    }

    .qr img {
        margin: 15px 0px;
    }


    .input:focus {
        border: 2px solid black;
    }

    .input:hover {
        border: 2px solid black;
    }

    @media screen and (max-width:800px) {
        .container {
            flex - direction: column;
            width: 700px;
            margin-top: 20px;
            height: auto;
        }

        .container-qr {
            display: block;
            margin: 25px auto;
            width: 500px;
        }

        .container-form {
            margin: 0 auto;
            width: 500px;
        }

        .sidebar {
            z - index: 5;
            box-shadow: 15px 19px 4px -19px rgb(108, 156, 245);
        }

        .sidebar-hide {
            display: none;
        }
    }

    @media screen and (max-width:600px) {
        .container {
            width: 450px;
        }

        .container-qr {
            width: 300px;
        }

        .container-form {
            width: 300px;
        }
    }

    @media screen and (max-width:450px) {
        .container {
            width: 300px;
        }
    }
</style>
@endsection

@section('content')
<div class="content">
    <div class="container">
        <div class="container-form">
            <form class="form" onsubmit="callGenerateQR()">
                <h3 style="margin-top: 15px"> Cadena para el QR</h3>
                <div style="align-items: center; margin: 15px 0px ">
                    <label for="string"> Texto: </label>
                    <input class="input" type="text" name="string" id="string" style="width: 60%"
                        placeholder="Ingrese texto a generar QR">
                </div>
                <input class="button button__color-lightgray m__b-4" type="submit" value="Generar QR">
            </form>
        </div>
        <div class="container-qr">
            <div class="qr" id="qrJS">
                <h3>QR generado con JavaScript</h3>
            </div>
            <div class="qr" id="qrLaravel">
                <h3>QR generado con Laravel</h3>
                {{-- < img src="/portafolio-laravel/public/vesil.png" width="150" style="margin-top: -10px"> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
    integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function callGenerateQR() {
        event.preventDefault();
        if (document.getElementById('string').value) {
            let text = document.getElementById('string').value;
            generateQRJS(text)
            generateQRLaravel(text)
        } else alert("Ingrese el Texto")
    }

    function generateQRJS(text) {

            let containerQR = document.getElementById('qrJS')
            containerQR.innerHTML = "<h3>QR generado con JavaScript</h3>"
            new QRCode(containerQR, {
                text: text,
                height: 110,
                width: 110
            })
    }

    function generateQRLaravel(text) {
            document.getElementById('qrLaravel').innerHTML = '<h3>Generando Codigo QR en Laravel. Espere por favor</h3>'
            let url = "<?php echo config('constants.Url'); ?>"



            fetch(url + "api/qrLaravel/" + text, {
                    method: 'get',
                    headers: {
                        "Accept": "application/json",
                    },
                })
                .then(response => {
                    return response.json()
                })
                .then(json => {
                    if (json.success) { //lo hice asi ya que no logre que funcionara el try catch
                        document.getElementById('qrLaravel').innerHTML =
                            '<h3>QR generado con Laravel</h3> <img src="' +
                            url + '/qr/qr.svg" width = "120" / > '
                    } else document.getElementById('qrLaravel').innerHTML = '<h3>Error generando QR en Laravel</h3>'
                })
                .catch(error => {
                    document.getElementById('qrLaravel').innerHTML = '<h3>Error generando QR en Laravel</h3>'
                });
    }
</script>
@endpush