<?php 


namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;

final class BooksImport implements ToModel, WithHeadingRow
{
    public function model(array $row) {
        return [
        ];
    }
}