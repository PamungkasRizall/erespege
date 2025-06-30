<div class="col-span-12">
    <div class="card col-span-12 mt-12 bg-gradient-to-r from-blue-500 to-blue-600 p-5 sm:col-span-8 sm:mt-0 sm:flex-row">
        <div class="flex justify-center sm:order-last">
            <img
                class="-mt-16 h-40 sm:mt-0"
                src="{{ asset('images/illustrations/doctor.svg') }}"
                alt="image">
        </div>
        <div class="mt-2 flex-1 pt-2 text-center text-white sm:mt-0 sm:text-left">
            <h3 class="text-xl">
                Selamat Datang, <span class="font-semibold">{{ Auth::user()->name }}</span>
            </h3>

            <p class="mt-2 leading-relaxed">Semoga Harimu Menyenangkan di Tempat Kerja</p>
            <p class="mt-1"></p>
            @if (!$lastCredential)

                <h2 class="text-sm-plus font-medium tracking-wide">
                    @if ($isDocumentCompleted)
                        @if ($isDocumentApproved)
                            (?) Dokumen Telah Disetujui Oleh Sub Komite
                            <br/>
                            @include('livewire.applications.credential.btn-transparent', ['btnText' => 'Assesmen Sekarang', 'btnRoute' => route("applications.credential.assessments.create")])
                        @else
                            (?) Dokumen Sedang Direview Oleh Sub Komite
                        @endif
                    @else
                        (?) Silahkan Mengisi Dokumen Dibawah Untuk Melakukan <span class="font-semibold">Assesmen Kredensial!</span>
                    @endif
                </h2>

            @else
                @if ($lastCredential->status === \App\Enums\FilingStatus::DONE)
                    @if ($assessmentOnPeriod)
                        <h2 class="text-sm-plus font-medium tracking-wide">(?) <i>Saat ini Anda Memasuki Masa Assesmen, Jangan Sampai Terlewat! (Batas Waktu: <b>{{ $lastCredential->end_date->locale('id_ID')->format('d M Y') }}</b>)</i></h2>

                        @include('livewire.applications.credential.btn-transparent', ['btnText' => 'Assesmen Sekarang', 'btnRoute' => route("applications.credential.assessments.create")])
                    @else
                    <h2 class="text-sm-plus font-medium tracking-wide">(?) Assesmen Aktif (Periode: <b>{{ $lastCredential->start_date->locale('id_ID')->format('d M Y') }} s/d {{ $lastCredential->end_date->locale('id_ID')->format('d M Y') }}</b>)</h2>
                    @endif
                @endif

                @if ($lastCredential->status === \App\Enums\FilingStatus::REVIEW)
                    <h2 class="text-sm-plus font-medium tracking-wide">(?) Assesmen Kredensial Sedang Direview oleh Assesor</h2>
                @endif

                @if ($lastCredential->status === \App\Enums\FilingStatus::SUB_COMMITTEE && !$lastCredential->origin->value)
                    <h2 class="text-sm-plus font-medium tracking-wide">(?) Dokumen Sedang Direview Oleh Sub Komite, Mohon Menunggu / Silahkan Lengkapi Semua Dokumen</h2>
                @endif

                @if ($lastCredential->status === \App\Enums\FilingStatus::HEAD_OF_COMMITTEE)
                    <h2 class="text-sm-plus font-medium tracking-wide">(?) Assesmen Kredensial Sedang Direview oleh Ketua Komite</h2>
                @endif

                @if ($lastCredential->status === \App\Enums\FilingStatus::PENDING)
                    <h2 class="text-sm-plus font-medium tracking-wide">(?) Assesmen Kredensial Sedang Berlangsung</h2>

                    @include('livewire.applications.credential.btn-transparent', ['btnText' => 'Lanjutkan Assesmen Sekarang', 'btnRoute' => route("applications.credential.assessments.create")])
                @endif

            @endif
        </div>
    </div>
</div>
