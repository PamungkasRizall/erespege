<?php

namespace App\Imports;

use App\Enums\CompetenceDetail;
use App\Models\CompetenceDetail as ModelsCompetenceDetail;
use Exception;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CompetenceImport implements ToCollection, WithHeadingRow //ToModel,
{
    public string $competence_id = '';

    public ?string $full_code = null;
    public int $group = 0;
    public string $unit = '';
    public string $element = '';

    public int $increment = 0;
    public ?int $parent_id = null;
    public int $i_group = 0;
    public int $i_unit = 0;
    public int $i_unit_all = 0;
    public int $i_element_all = 0;

    public function __construct(string $competence_id)
    {
        $this->competence_id = $competence_id;

        $lastID = ModelsCompetenceDetail::latest('id')->first();
        $this->increment = $lastID ? $lastID->id : 0;
    }

    public function collection(Collection $rows)
    {
        if($rows->contains('rincian_kewenangan_klinis', null))
            throw new Exception('Rincian Kewenangan Klinis Ada Yang Kosong');

        $details = $rows->map(function ($item, $key) {

            $this->increment += 1;

            $no = $item['no'];
            $name = trim($item['rincian_kewenangan_klinis']);

            $type = match (true) {
                is_string($no) => CompetenceDetail::UNIT,
                is_numeric($no) => CompetenceDetail::ELEMENT,
                default => CompetenceDetail::GROUP,
            };

            if ($type == CompetenceDetail::GROUP)
            {
                $this->group += 1;

                $this->unit = '';
                $this->element = '';
                $this->parent_id = null;

                $this->i_group = $this->increment;
            }

            if ($type == CompetenceDetail::UNIT)
            {
                $this->i_unit_all += 1;
                $this->unit = $no;
                $this->element = '';
                $this->parent_id = $this->i_group;

                $this->i_unit = $this->increment;
            }

            if ($type == CompetenceDetail::ELEMENT)
            {
                $this->element = (int) $no;
                $this->parent_id = $this->i_unit;
                $this->i_element_all += 1;
            }

            $this->full_code = trim(sprintf(
                '%s/%s/%s/%s',
                CompetenceDetail::GROUP->prefix() . $this->group,
                trim($this->unit),
                $this->i_unit_all,
                $this->element
            ), '/');

            return collect([
                'id' => $this->increment,
                'full_code' => $this->full_code,
                'type' => $type,
                'name' => $name,
                'serial_number' => ($type == CompetenceDetail::ELEMENT) ? $this->i_element_all : null,
                'competence_id' => $this->competence_id,
                'parent_id' => $this->parent_id,
            ]);
        });

        ModelsCompetenceDetail::where('competence_id', $this->competence_id)->delete();
        ModelsCompetenceDetail::insert($details->toArray());

        return json_encode(['success' => 'success', 'message' => 'Done!']);
    }

    // public function batchSize(): int
    // {
    //     return 1000;
    // }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 4;
    }
}
