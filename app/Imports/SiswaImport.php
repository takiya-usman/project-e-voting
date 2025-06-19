<?php

namespace App\Imports;

use App\Models\User;
use App\Models\kelas;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Exception;



class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $kelas = Kelas::where('name', $row[1])->first();
        if (!$kelas) {
            throw new Exception('Kelas tidak ditemukan pada tabel Kelas');
        }
        $default_status = 0; // set default status

        if (isset($row[6])) { // check if status column exists
            $default_status = $row[6]; // set default status to the value from excel
        }

        return new User([
            'kelas_id' => $kelas->id,
            'nisn' => $row[2],
            'name' => $row[3],
            'jenis_kelamin' => $row[4],
            'email' => $row[5],
            'status' => $default_status, // set default status
            'password' => Hash::make($row[2]), // password sama dengan NISN
        ]);
    }
}
