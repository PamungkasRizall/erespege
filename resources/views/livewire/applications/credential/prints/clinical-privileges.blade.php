@php
    $space = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
@endphp
<html>
    <head>
        <title>CLINICAL PRIVILIGES</title>
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
                width: 20%;
                height: 20px;
                font-size: 14.667px;
            }

            .column3 {
                float: left;
                text-align: center;
                width: 47%;
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
                    SURAT PENUGASAN KEWENANGAN KLINIS
                </p>
                <p style="text-align: center; font-weight: bold; margin-top: -1em; text-transform: uppercase;">
                    (CLINICAL PRIVILEGES)
                </p>
                <p style="text-align: center; margin-top: -1em; font-size: 12px;">
                    NOMOR :
                    @if ($filing->status->value > \App\Enums\FilingStatus::PEMBERKASAN->value)
                        {{ $filing->letter_no }}
                    @else
                        <b style="color: red;">BELUM TERSEDIA</b>
                    @endif
                </p>

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Yang bertanda tangan dibawah ini:
                    </div>
                </div>
                @php
                    $user = $filing->user;
                @endphp
                <table style="padding-top: 1em; padding-bottom: 1em;">
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="2%">:</td>
                        <td>{{ env('DIRUT_NAME') }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ env('DIRUT_NIP') }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>Direktur Utama</td>
                    </tr>
                </table>

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Dengan ini memberikan kewenangan klinis sebagaimana tercantum dalam lampiran Kewenangan Klinis Tenaga {{ $user->profile->profession->name }}, Kepada:
                    </div>
                </div>

                <table style="padding-top: 1em; padding-bottom: 1em;">
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="2%">:</td>
                        <td>{{ $user->full_name }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{ $user->nip }}</td>
                    </tr>
                    <tr>
                        <td>Kualifikasi</td>
                        <td>:</td>
                        <td>Tenaga {{ $user->profile->profession->name }}</td>
                    </tr>
                </table>

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Dan kepada yang bersangkutan berhak dan dapat memberikan asuhan kepada pasien sesuai dengan Rincian Kewenangan Klinis {{ $user->profile->profession->name }}
                    </div>
                </div>

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Demikian surat penugasan kewenangan klinis ini untuk dapat dilaksanakan
                    </div>
                </div>

                <div class="row" style="padding-top: 3em;">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">Bogor, {{ \Carbon\Carbon::parse($filing->cp_at)->locale('id')->translatedFormat('d F Y') }}</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3"></div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">Direktur Utama</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">{{ env('APP_LOCATION') }}</div>
                </div>
                <div class="row">
                    <div class="column" style="height: 70px; padding-top: 5px;"></div>
                    <div class="column2" style="height: 70px;"></div>
                    <div class="column3" style="height: 70px; padding-top: 5px;"></div>
                </div>
                <div class="row">
                    <div class="column" style="font-weight: bold;"></div>
                    <div class="column2"></div>
                    <div class="column3" style="font-weight: bold; text-align: left;">
                        {{ env('DIRUT_NAME') }}
                    </div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">NIP. {{ env('DIRUT_NIP') }}</div>
                </div>
                <div class="row" style="padding-top: 3em;">
                    <img src="{{ public_path() . '/images/footer-surat.jpg' }}" width="100%"/>
                </div>
            </p>

            <p style="page-break-after: always;">
                <header style="text-align: center;">
                    <img src="{{ public_path() . '/images/kop-surat.jpg' }}" width="100%"/>
                </header>

                <p style="text-align: center; padding-top: 8em; font-weight: bold; text-transform: uppercase;">
                    RINCIAN KEWENANGAN KLINIS TENAGA {{ $user->profile->profession->name }}
                </p>

                Berdasarkan hasil kredensial yang dilakukan pada tanggal <b>{{ \Carbon\Carbon::parse($beritaAcara->date_at)->locale('id')->translatedFormat('d F Y') }}</b> dengan ini Direktur Utama {{ env('APP_LOCATION') }} menetapkan bahwa:
                @include('livewire.applications.credential.prints.profile')

                Rincian Kewenangan Klinis (RKK)
                @include('livewire.applications.credential.prints.rkk')

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Demikian Rincian Kewenangan Klinis ini diberikan selama {{ \App\Models\Filing::ACTIVE_PERIOD }} ({{ terbilang(\App\Models\Filing::ACTIVE_PERIOD) }}) tahun sejak tanggal ditetapkan untuk dapat dipergunakan serta dilaksanakan di {{ env('APP_LOCATION') }} dengan penuh tanggung jawab dan sebagaimana mestinya.
                    </div>
                </div>

                <div class="row" style="padding-top: 3em;">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">Bogor, {{ \Carbon\Carbon::parse($filing->cp_at)->locale('id')->translatedFormat('d F Y') }}</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3"></div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">Direktur Utama</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">{{ env('APP_LOCATION') }}</div>
                </div>
                <div class="row">
                    <div class="column" style="height: 70px; padding-top: 5px;"></div>
                    <div class="column2" style="height: 70px;"></div>
                    <div class="column3" style="height: 70px; padding-top: 5px;"></div>
                </div>
                <div class="row">
                    <div class="column" style="font-weight: bold;"></div>
                    <div class="column2"></div>
                    <div class="column3" style="font-weight: bold; text-align: left;">
                        {{ env('DIRUT_NAME') }}
                    </div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3" style="text-align: left;">NIP. {{ env('DIRUT_NIP') }}</div>
                </div>
                <div class="row" style="padding-top: 3em;">
                    <img src="{{ public_path() . '/images/footer-surat.jpg' }}" width="100%"/>
                </div>
            </p>
        </main>
    </body>
</html>
