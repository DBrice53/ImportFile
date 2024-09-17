<?php

namespace App\Imports;

use App\Models\Import;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportFiles implements ToCollection, WithHeadingRow
{
    /**
     * Transforme une ligne du fichier Excel en un modèle
     *
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Déboguer les données de la ligne actuelle
            dd($row);

            Import::create([
                'name' => $row['Name'], // Colonne 'name' selon l'en-tête
                'department' => $row['Department'], // Colonne 'department' selon l'en-tête
                'date' => $row['Date'],
                'shift' => $row['Shift'],
                'timetable' => $row['Timetable'],
                'attendance_status' => $row['Attendance Status'],
                'check_in' => $row['Check-In'],
                'check_out' => $row['Check-out'],
                'late' => $row['Late'],
                'early_leave' => $row['Early Leave'],
                'attended' => $row['Attended'],
                'absent' => $row['Absent'],
                'worked' => $row['Worked'],
                'break' => $row['Break'],
                'leave_type' => $row['Leave Type'],
                'leave' => $row['Leave'],
                'ot1' => $row['OT1'],
                'ot2' => $row['OT2'],
                'ot3' => $row['OT3'],
            ]);
        }
    }
}
