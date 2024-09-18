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
            try {
                Import::create([
                    'name' => $row['name'] ?? null,
                    'department' => $row['department'] ?? null,
                    'date' => $row['date'] ?? null,
                    'shift' => $row['shift'] === '-' ? null : $row['shift'],
                    'timetable' => $row['timetable'] === '-' ? null : $row['timetable'],
                    'attendance_status' => $row['attendance_status'] ?? null,
                    'check_in' => $row['check_in'] === '-' ? null : $row['check_in'],
                    'check_out' => $row['check_out'] === '-' ? null : $row['check_out'],
                    'late' => $this->convertMinutes($row['late']),
                    'early_leave' => $this->convertMinutes($row['early_leave']),
                    'attended' => $this->convertMinutes($row['attended']),
                    'absent' => $this->convertMinutes($row['absent']),
                    'worked' => $this->convertMinutes($row['worked']),
                    'break' => $this->convertMinutes($row['break']),
                    'leave_type' => $row['leave_type'] === '-' ? null : $row['leave_type'],
                    'leave' => $this->convertMinutes($row['leave']),
                    'ot1' => $this->convertMinutes($row['ot1']),
                    'ot2' => $this->convertMinutes($row['ot2']),
                    'ot3' => $this->convertMinutes($row['ot3']),
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }

    /**
     * Convertit une chaîne de minutes ("0 min") en nombre.
     *
     * @param string $time
     * @return int|null
     */
    private function convertMinutes($time)
    {
        // Vérifiez si le format est "0 min"
        if (strpos($time, 'min') !== false) {
            return (int) filter_var($time, FILTER_SANITIZE_NUMBER_INT);
        }
        return null;
    }
    
}
