<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TES JUNIOR WEB DEVELOPER LARAVEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Looping
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Hitung
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">input
                                                    looping</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('postLoop') }}" method="post">
                                                @csrf
                                                <div class="modal-body" style="display: grid">
                                                    <label for="input-user">Jumlah Looping</label>
                                                    <input type="number" name="input-user" id="input-user">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Mulai!</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @if (@isset($HasilPerulangan))
                                    <div class="container">
                                        <div class="row" style="display:flex;flex-wrap:wrap;">
                                            <h1>Hasil</h1>
                                            <p>Kelipatan 3 dan 5: {{ $HasilPerulangan['kelipatanTigaNLima'] }} </p>
                                            <p>Kelipatan 3: {{ $HasilPerulangan['kelipatanTiga'] }} </p>
                                            <p>Kelipatan 5: {{ $HasilPerulangan['kelipatanLima'] }} </p>
                                            <p>Bage Concat: {{ $HasilPerulangan['munculBageconcat'] }}x </p>
                                            @foreach ($HasilPerulangan['number'] as $list)
                                                <div class="col-md-2">
                                                    <p><strong>{{ $list }}</strong></p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Cek Ongkos Kirim
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div id="jasa-pengiriman" class="accordion-body text-center">
                                @if (@isset($arrayDatas['ListCities']))
                                    <form action="{{ route('postReqCity') }}" method="post">
                                        @csrf
                                        <fieldset>
                                            <legend>Cek Ongkos Kirim</legend>
                                            <div class="mb-3">
                                                <label for="kota-awal" class="form-label">Kota Awal</label>
                                                <select id="kota-awal" name="kota-awal" class="form-select">
                                                    @foreach ($arrayDatas['ListCities'] as $item)
                                                        {
                                                        @if ($item['province_id'] == 5)
                                                            <option value="{{ $item['city_id'] }}">
                                                                {{ $item['city_name'] }}
                                                            </option>
                                                        @endif
                                                        }
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kota-tujuan" class="form-label">Kota Tujuan</label>
                                                <select id="kota-tujuan" name="kota-tujuan" class="form-select">
                                                    @foreach ($arrayDatas['ListCities'] as $item)
                                                        {
                                                        <option value="{{ $item['city_id'] }}">
                                                            {{ $item['city_name'] }}
                                                        </option>
                                                        }
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="weight-package" class="form-label">Berat Paket (gram):
                                                </label>
                                                <input type="number" id="weight-package" name="weight-package"
                                                    class="form-control" placeholder="0" value="0">
                                            </div>
                                            <div class="mb-3">
                                                <label for="vendor-courier" class="form-label">Kurir Paket: </label>
                                                <select id="vendor-courier" name="vendor-courier" class="form-select"
                                                    required>
                                                    <option selected>...</option>
                                                    <option value="jne">JNE</option>
                                                    <option value="pos">POS</option>
                                                    <option value="tiki">TIKI</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </fieldset>
                                    </form>
                                @else
                                    <p>Data API tidak ada | <a href="/">Click to Refresh</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if (@isset($arrayDatas['ResAPIOrigin']))
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <form>
                                    @csrf
                                    <fieldset>
                                        <legend>Struk Jasa Pengiriman {{ $arrayDatas['ResAPICost'][0]['name'] }}
                                        </legend>
                                        <div class="mb-3">
                                            <label for="kota-awal" class="form-label">Kota Awal</label>
                                            <input type="text" id="kota-awal" name="kota-awal"
                                                class="form-control"
                                                placeholder="{{ $arrayDatas['ResAPIOrigin']['city_name'] }}"value="{{ $arrayDatas['ResAPIOrigin']['city_name'] }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kota-tujuan" class="form-label">Kota Tujuan</label>
                                            <input type="text" id="kota-awal" name="kota-awal"
                                                class="form-control"
                                                placeholder="{{ $arrayDatas['ResAPIDest']['city_name'] }}"value="{{ $arrayDatas['ResAPIDest']['city_name'] }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="weight-package" class="form-label">Berat Paket (gram):
                                            </label>
                                            <input type="text" id="kota-awal" name="kota-awal"
                                                class="form-control"
                                                placeholder="{{ $arrayDatas['ResAPIQuery']['weight'] }}"value="{{ $arrayDatas['ResAPIQuery']['weight'] }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <legend>Kurir/Jasa Pengiriman {{ $arrayDatas['ResAPICost'][0]['name'] }}
                                            </legend>
                                            <label for="vendor-courier" class="form-label">Services</label>
                                            <select id="vendor-courier" name="vendor-courier" class="form-select">
                                                @foreach ($arrayDatas['ResAPICost'][0]['costs'] as $item)
                                                    {
                                                    <option value="{{ $item['service'] }}">
                                                        {{ $item['service'] }} - Rp. {{ $item['cost'][0]['value'] }} -
                                                        Estimasi Sampai
                                                        {{ $item['cost'][0]['etd'] }}
                                                    </option>
                                                    }
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Pesan</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
