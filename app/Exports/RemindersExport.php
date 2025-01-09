<?php

namespace App\Exports;

use App\Models\Remender;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RemindersExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Remender::with(['phone', 'email'])->get()->map(function ($reminder) {
            $phones = $reminder->phone ? $reminder->phone->pluck('phone')->implode(', ') : '';
            $emails = $reminder->email ? $reminder->email->pluck('email')->implode(', ') : '';
            $status = $reminder->RemenderTimeCompare($reminder->date)
                ? __('cruds.remenders.endtime')
                : __('cruds.remenders.starttime');
            return [
                'id' => $reminder->id,
                'name' => $reminder->name,
                'desc' => $reminder->desc,
                'date' => $reminder->date,
                'phones' => $phones,
                'emails' => $emails,
                'status' => $status
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Напоминание',
            'Организация',
            'Время',
            'Телефоны',
            'Электронная почта',
            'статус'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $sheet->getRowDimension(1)->setRowHeight(20);
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => 'center'],
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ]
        ]);

        $sheet->getStyle('A2:G' . $sheet->getHighestRow())->applyFromArray($styleArray);

        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
