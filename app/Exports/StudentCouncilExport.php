<?php

namespace App\Exports;

use App\Model\TopicProtection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class StudentCouncilExport implements FromView
{
      public function view(): View
    {
        return view('exports.TopicProtection', [
            'TopicProtection' => TopicProtection::with('topics')->with('students')->orderBy('created_at','DESC')->get()
        ]);
    }
}
