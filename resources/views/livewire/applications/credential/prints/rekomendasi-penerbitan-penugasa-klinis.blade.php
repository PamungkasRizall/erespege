@php
    $space = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $recomendation_at = $filing->recomendation_at ?: \Carbon\Carbon::now();
@endphp
<html>
    <head>
        <title>SURAT REKOMENDASI PENERBITAN PENUGASAN KLINIS</title>
        <meta name="description" content="REKOMENDASI">
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
                width: 50%;
                height: 20px;
                font-size: 14.667px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            ol li {
                font-weight:bold;
            }
            li > p, li > table {
                font-weight:normal;
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

                <p style="text-align: right; padding-top: 7.5em;">
                    Bogor,{{ \Carbon\Carbon::parse($recomendation_at)->locale('id')->translatedFormat('d F Y') }}
                </p>
                <div class="row">
                    <div style="float: left; width: 1in;">Nomor</div>
                    <div style="float: left; width: 0.12in;">:</div>
                    <div style="float: left;">
                        @if ($filing->recomendation_code)
                            {{ $filing->recomendation_code }}
                        @else
                            <b style="color: red;">BELUM DI REVIEW</b>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div style="float: left; width: 1in;">Lampiran</div>
                    <div style="float: left; width: 0.12in;">:</div>
                    <div style="float: left;">1 (Satu) Berkas</div>
                </div>
                <div class="row">
                    <div style="float: left; width: 1in;">Perihal</div>
                    <div style="float: left; width: 0.12in;"></div>
                    <div style="float: left; width: 5.5in;">Surat Rekomendasi Penerbitan Penugasan Klinis</div>
                </div>

                <div class="row" style="padding-top: 3em;">
                    <div style="float: left;">Yth. Direktur Utama</div>
                </div>
                <div class="row">
                    <div style="float: left;">{{ env('APP_LOCATION') }}</div>
                </div>
                <div class="row">
                    <div style="float: left;">di</div>
                </div>
                <div class="row">
                    <div style="float: left; padding-left: 30px;">Tempat</div>
                </div>

                <div class="row" style="padding-top: 3em; padding-bottom: 1em;">
                    <div class="justify" style="float: left;">
                        Berdasarkan hasil kredensial Komite {{ $beritaAcara->profession->committee->naming() }} terhadap rincian kewenangan klinis yang dilakukan pada tanggal <b>{{ \Carbon\Carbon::parse($beritaAcara->date_at)->locale('id')->translatedFormat('d F Y') }}</b> oleh Sub Komite Kredensial {{ $beritaAcara->profession->committee->naming() }} dengan Mitra Bestari Profesi, dengan ini kami mengajukan rekomendasi untuk pemberian Surat Penugasan Klinis (SPK) untuk:
                    </div>
                </div>

                <table class="table-bordered" style="font-weight: normal; font-size: 14.667px; padding-top: 0.2em; padding-bottom: 1em;" cellspacing="0" cellpadding="4">
                    <thead>
                        <tr style="font-weight: bold; text-align: center;">
                            <td width="5%">No</td>
                            <td>Nama</td>
                            <td>NIP</td>
                            <td>Profesi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $user = $filing->user;
                        @endphp
                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500;">
                            <td class="px-2 py-1 sm:px-3" style="text-align: center;">1</td>
                            <td style="text-align: center;">{{ $user->full_name }}</td>
                            <td style="text-align: center;">{{ $user->nip }}</td>
                            <td style="text-align: center;">{{ $user->profile->profession->name }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row" style="padding-top: 1em;">
                    <div class="justify" style="float: left;">
                        Demikian surat rekomendasi ini kami ajukan agar dapat diterbitkan surat penugasan klinis (SPK) bagi tenaga ksehatan tersebut. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.
                    </div>
                </div>

                <div class="row" style="padding-top: 3em;">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">Hormat Kami</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">Ketua Komite {{ $beritaAcara->profession->committee->naming() }}</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">{{ env('APP_LOCATION') }}</div>
                </div>
                <div class="row">
                    <div class="column" style="height: 70px; padding-top: 5px;"></div>
                    <div class="column2" style="height: 70px;"></div>
                    <div class="column3" style="height: 70px; padding-top: 5px;">
                        @if ($filing->recomendation_code)
                            <img src="data:image/png;base64,
                                {!! base64_encode(
                                        QrCode::format('svg')
                                        ->size(60)
                                        ->errorCorrection('H')
                                        ->generate('['.$headOfCommittee->user->full_name.' | '.$headOfCommittee->created_at->format('d/m/Y H:i').']: '.$headOfCommittee->notes)
                                    )
                                !!}"
                            >
                        @else
                            <b style="color: red;">BELUM DI REVIEW</b>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="column" style="font-weight: bold;"></div>
                    <div class="column2"></div>
                    <div class="column3" style="font-weight: bold;">
                        {{ $headOfCommittee->full_name ?? $headOfCommittee->user->full_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">NIP. {{ $headOfCommittee->nip ?? $headOfCommittee->user->nip }}</div>
                </div>
                <div class="row" style="padding-top: 3em;">
                    <img src="{{ public_path() . '/images/footer-surat.jpg' }}" width="100%"/>
                </div>
            </p>

            <p style="page-break-after: always;">
                <header style="text-align: center;">
                    <img src="{{ public_path() . '/images/kop-surat.jpg' }}" width="100%"/>
                </header>

                <p style="text-align: center; padding-top: 8em; font-weight: bold;">
                    REKOMENDASI PENERBITAN SURAT PENUGASAN KLINIS
                </p>

                <ol type="I" style="padding-left: 0.7cm; margin-bottom: -5px;">
                    <li>
                        Identitas Tenaga Kesehatan

                        @include('livewire.applications.credential.prints.profile')

                    </li>
                    <li>
                        Rincian Kewenangan Klinis (RKK)

                        @include('livewire.applications.credential.prints.rkk')

                    </li>
                    <li>Masa Berlaku Penugasan Klinis</li>
                </ol>

                <div class="row" style="padding-top: 1em; padding-bottom: 1em;">
                    <div class="justify" style="float: left;">
                        Masa berlaku SPK diberikan selama {{ \App\Models\Filing::ACTIVE_PERIOD }} ({{ terbilang(\App\Models\Filing::ACTIVE_PERIOD) }}) tahun sejak dikeluarkannya rekomendasi ini, selanjutnya akan dilakukan rekredensial sejak tanggal ditetapkan.
                    </div>
                </div>

                <div class="row" style="padding-top: 3em;">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">Bogor, {{ \Carbon\Carbon::parse($recomendation_at)->locale('id')->translatedFormat('d F Y') }}</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">Hormat Kami,</div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">Ketua Komite {{ $beritaAcara->profession->committee->naming() }}</div>
                </div>
                <div class="row">
                    <div class="column" style="height: 70px; padding-top: 5px;"></div>
                    <div class="column2" style="height: 70px;"></div>
                    <div class="column3" style="height: 70px; padding-top: 5px;">
                        @if ($filing->recomendation_code)
                            <img src="data:image/png;base64,
                                {!! base64_encode(
                                        QrCode::format('svg')
                                        ->size(60)
                                        ->errorCorrection('H')
                                        ->generate('['.$headOfCommittee->user->full_name.' | '.$headOfCommittee->created_at->format('d/m/Y H:i').']: '.$headOfCommittee->notes)
                                    )
                                !!}"
                            >
                        @else
                            <b style="color: red;">BELUM DI REVIEW</b>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="column" style="font-weight: bold;"></div>
                    <div class="column2"></div>
                    <div class="column3" style="font-weight: bold;">
                        {{ $headOfCommittee->full_name ?? $headOfCommittee->user->full_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="column"></div>
                    <div class="column2"></div>
                    <div class="column3">NIP. {{ $headOfCommittee->nip ?? $headOfCommittee->user->nip }}</div>
                </div>
                <div class="row" style="padding-top: 3em;">
                    <img src="{{ public_path() . '/images/footer-surat.jpg' }}" width="100%"/>
                </div>
            </p>
        </main>
    </body>
</html>
