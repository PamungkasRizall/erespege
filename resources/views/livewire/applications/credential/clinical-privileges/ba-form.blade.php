<div class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6 p-4">

    @include('livewire.applications.credential.clinical-privileges.ba-expanded')

    <x-forms.input wire:model="notes" title="Catatan" placeholder="Catatan Jika Ada, Untuk Di Scan Menjadi QRcode" labelStyle="margin-bottom: -2em;" />

    <x-forms.button-submit buttonName="Setujui" wireClick="approvalSubCommittee"/>
</div>
