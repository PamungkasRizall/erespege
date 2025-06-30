@php
    $space = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $sub_committee = $beritaAcara->approvals()->first();
@endphp
<html>
    <head>
        <title>BERITA ACARA</title>
        <meta name="description" content="BA">
        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14.667px;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: {{ isset($_GET['top']) ? $_GET['top'] : 1.2 }}cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: {{ isset($_GET['bottom']) ? $_GET['bottom'] : 1 }}cm;
            }

            /** Define the header rules **/
            /* header {
                position: absolute;
                top: 1cm;
                left: 2cm;
                right: 2cm;
                height: 2.3cm;
            } */
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                /* height: 5.3cm; */
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
            }

            table {
                width: 100%;
            }

            table.header {
                /* font-size: 12; */
                font-weight: bold;
                text-transform: uppercase;
            }

            table.v-top td {
                vertical-align: top;
            }

            ol.bold li {
                font-weight: bold;
            }

            ol.bold li p {
                font-weight: normal;
                margin-top: unset;
            }

            li.cols-a ul, li.cols-a ol {
                padding-left: 0;
                margin-left: 1.3em;
            }

            li.cols-a ul li, li.cols-a ol li {
                font-weight: normal !important;
            }
            .tab {
                margin-left: 40px;
            }
            .justify {
                text-align: justify;
                text-justify: inter-word;
            }

            .ql-indent-1 {
                margin-left: 10px;
            }
            table.table-bordered > thead > tr > td, table.table-bordered > tbody > tr > td{
                border:solid 1px rgb(55, 53, 53) !important;
            }

            .column {
                float: left;
                text-align: center;
                width: 30%;
                height: 20px;
                font-size: 14.667px;
            }

            .column2 {
                float: left;
                width: 40%;
                height: 20px;
                font-size: 14.667px;
            }

            .column3 {
                float: left;
                text-align: center;
                width: 30%;
                height: 20px;
                font-size: 14.667px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }
        </style>
    </head>

    <body>
        <!-- Define header and footer blocks before your content -->

        <footer>
            {{-- Copyright &copy; 2022 --}}
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <p style="page-break-after: never;">
                <header style="text-align: center; padding-top: 2em;">
                    <img src="{{ public_path() . '/images/kop-surat.jpg' }}" width="100%"/>
                </header>

                <p style="text-align: center; padding-top: 7.5em; font-weight: bold;">
                    BERITA ACARA
                </p>
                <p style="text-align: center; font-weight: bold; margin-top: -0.5em; text-transform: uppercase;">
                    PELAKSANAAN KREDENSIAL TENAGA TEKNIS {{ $beritaAcara->profession->name }}
                </p>
                <p style="text-align: center; margin-top: -1em; font-size: 12px;">
                    NOMOR : {{ $beritaAcara->code }}
                </p>

                <div class="row" style="padding-top: 1em; padding-bottom: 1em;">
                    <div class="justify" style="float: left;">
                        Pada hari ini, <b>{{ \Carbon\Carbon::parse($beritaAcara->date_at)->locale('id')->translatedFormat('l') }}</b>, tanggal <b>{{ \Carbon\Carbon::parse($beritaAcara->date_at)->locale('id')->translatedFormat('d F Y') }}</b>, telah menyelesaikan pelaksanaan kredensial {{ $beritaAcara->profession->name }} {{ env('APP_LOCATION', 'NULL') }}. Dilaksanakan di <b>{{ $beritaAcara->location }}</b> dengan jumlah peserta kredensial <b>{{ terbilang(count($beritaAcara->filings)) }}</b> {{ $beritaAcara->profession->name }}. Kami lampirkan nama peserta kredensial sebagai berikut:
                    </div>
                </div>

                <table class="table-bordered" style="font-weight: normal; font-size: 14.667px; padding-top: 0.2em; padding-bottom: 1em;" cellspacing="0" cellpadding="4">
                    <thead>
                        <tr style="font-weight: bold; text-align: center;">
                            <td width="5%">No</td>
                            <td>Nama</td>
                            <td>NIP</td>
                            <td>Jenis Tenaga Kesehatan</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filings as $filing)
                            @php
                                $user = $filing->user;
                            @endphp
                            <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="px-2 py-1 sm:px-3" style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->nip }}</td>
                                <td>{{ $user->profile->profession->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Nama tenaga kesehatan di atas telah menyelesaikan proses kredensial dengan baik. Untuk itu, dimohon Ketua Komite Tenaga Kesehatan Lainnya memberikan kewenangan klinis atas nama {{ $beritaAcara->profession->name }} di atas.
                    </div>
                </div>

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Demikian berita acara ini kami buat, atas perhatiannya diucapkan terima kasih.
                    </div>
                </div>

                <div class="row" style="padding-top: 3em;">
                    <div class="column">Sub Komite Kredensial</div>
                    <div class="column2"></div>
                    <div class="column3">Mitra Bestari</div>
                </div>
                <div class="row">
                    <div class="column" style="height: 70px; padding-top: 5px;">
                        @if ($sub_committee)
                        <img src="data:image/png;base64,
                            {!! base64_encode(
                                    QrCode::format('svg')
                                    ->size(60)
                                    ->errorCorrection('H')
                                    ->generate('['.$sub_committee->user->full_name.' | '.$sub_committee->created_at->format('d/m/Y H:i').']: '.$sub_committee->notes)
                                )
                            !!}"
                        >
                        @else
                            <b style="color: red;">BELUM DI REVIEW</b>
                        @endif
                    </div>
                    <div class="column2" style="height: 70px;"></div>
                    <div class="column3" style="height: 70px; padding-top: 5px;">
                        <img src="data:image/png;base64,
                            {!! base64_encode(
                                    QrCode::format('svg')
                                    ->size(60)
                                    ->errorCorrection('H')
                                    ->generate('['.$beritaAcara->assesor->full_name.' | '.$beritaAcara->assesor->created_at->format('d/m/Y H:i').']')
                                )
                            !!}"
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="column" style="font-weight: bold;">{{ $sub_committee ? $sub_committee->user->full_name : 'Menunggu Review' }}</div>
                    <div class="column2"></div>
                    <div class="column3" style="font-weight: bold;">{{ $beritaAcara->assesor->full_name }}</div>
                </div>
                <div class="row">
                    <div class="column">NIP. {{ $sub_committee ? $sub_committee->user->nip : '' }}</div>
                    <div class="column2"></div>
                    <div class="column3">NIP. {{ $beritaAcara->assesor->nip }}</div>
                </div>
                <div class="row" style="padding-top: 3em;">
                    <img src="{{ public_path() . '/images/footer-surat.jpg' }}" width="100%"/>
                </div>
            </p>
        </main>
    </body>
</html>
