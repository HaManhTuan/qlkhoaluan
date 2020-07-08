<?php

namespace App\Exports;

use App\Model\ProtectLecturer;
use App\Model\Protections;
use App\Model\CouncilProtect;
use App\Model\StudentCouncil;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class DetailCouncilExport implements FromCollection, WithHeadings
{
  protected $id;
  function __construct($id) {
    $this->id = $id;
  }
  public function collection()
  {
      $name_council = ProtectLecturer::with('protect')->where('id_council',$this->id)->first();
      $lecturer = ProtectLecturer::with('lecturer')->where('id_council',$this->id)->get();
      $StudentCouncil = StudentCouncil::where('id_council',$this->id)->get();
      $stt = 1;
      foreach ($StudentCouncil as $row) {
       
            $detail[] = array(
                '0' => $stt++,
                '1' => $row->msv,
                '2' => $row->name,
                '3' => $row->topic,
                '4' => $row->council,
                '5' => $row->score,
                
            );
        }
        return (collect($detail));
  }
  public function headings(): array
    {
        return [
            'STT',
            'MSV',
            'HỌ TÊN',
            'ĐỀ TÀI',
            'HỘI ĐỒNG',
            'ĐIỂM',
            'THÔNG TIN',
        ];
    }
}