<?php
  
namespace App\Exports;
  
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class LeadsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lead::select("id", "first_name", "last_name", "email", "mobile", "pin_code", "country", "state", "city")->get();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "First Name", "Last Name", "Email", "Mobile", "Pin Code", "Email", "Country", "State", "City"];
    }
}
