<?php

namespace App\Exports;

use App\Models\Keranjang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class DataPesananCustomersExport implements WithHeadings, FromCollection, ShouldAutoSize, WithEvents
{
    private $totalRows = 0;

    public function headings(): array
    {
        return [
            'Kode Pesanan',
            'Judul Buku',
            'Jumlah',
            'Harga',
            'Harga Ongkir',
            'Kurir',
            'Layanan Paket',
            'Status Pembayaran',
            'Total Harga',
            'Tanggal Masuk',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    
    public function collection()
    {
        $pesanan = Keranjang::join('orders', 'orders.id', '=', 'keranjangs.order_id')
                ->join('bukus', 'bukus.id', '=', 'keranjangs.buku_id')
                ->where('keranjangs.user_id', '<>', 1)
                ->orderBy('keranjangs.id', 'ASC')
                ->get([
                    'orders.uuid',
                    'bukus.judul_buku',
                    'keranjangs.quantity',
                    'bukus.harga',
                    'orders.harga_ongkir',
                    'orders.courier',
                    'orders.layanan_ongkir',
                    'keranjangs.payments',
                    'orders.total_belanja',
                    'orders.transaction_time'
                ]);

            // $data = [];
            // foreach ($fixData as $key => $row) {
            //     $data[$key] = date('Y-m-d', strtotime($row->created_at));
            // }

            // foreach($fixData as $key => $row) {
            //     $fixData[$key]->created_at = $data[$key]; 
            // }
            $fixData = $pesanan;

            return $fixData;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $totalRow       = $this->totalRows + 1; // + plus 1 for header
                $cellRange      = 'A1:J' . $totalRow;
                $event->sheet->getDelegate()->getStyle('A1:J1')->getFill()->setFillType(Fill::FILL_SOLID);
                $event->sheet->getDelegate()->getStyle('A1:J1')->getFill()->getStartColor()->setRGB('C19A6B');

                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ])->getAlignment()->setWrapText(true);
            },
        ];
    }
}
