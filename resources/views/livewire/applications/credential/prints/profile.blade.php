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
        <td>Profesi</td>
        <td>:</td>
        <td>{{ $user->profile->profession->name }}</td>
    </tr>
    <tr>
        <td>Unit Kerja</td>
        <td>:</td>
        <td>{{ (new \App\Services\UserService)->mainPosition($user)?->department->name }}</td>
    </tr>
    <tr>
        <td>No. STR</td>
        <td>:</td>
        <td>{{ $filing->str_code }}</td>
    </tr>
    <tr>
        <td>No. SIP/SIK</td>
        <td>:</td>
        <td>{{ $filing->sik_code }}</td>
    </tr>
</table>