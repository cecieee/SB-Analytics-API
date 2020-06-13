<?php

namespace App\Sheet;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\StudentDetail;

class SheetResolver
{

    public function __construct()
    {
        $this->table = array(
            'member_id' => 1,
            'first_name' => 2,
            'middle_name' =>3,
            'last_name' => 4,
            'renewal_category' => 5
        );

        $this->row = 2;
    }

    public function putToDatabase($path){
        $sheet_raw = new Xlsx;
        $sheet_raw->setReadDataOnly(true);
        $sheet = $sheet_raw->load($path);

        $this->row++;


        while(true){
            if($this->getValueAt($sheet, $this->table['member_id'], $this->row) == ''){
                break;
            }
            StudentDetail::firstOrCreate(
                ['member_id' => $this->getValueAt($sheet, $this->table['member_id'], $this->row)],
                [
                    'first_name' => $this->getValueAt($sheet, $this->table['first_name'], $this->row),
                    'middle_name' => $this->getValueAt($sheet, $this->table['middle_name'], $this->row),
                    'last_name' => $this->getValueAt($sheet, $this->table['last_name'], $this->row),
                    'renewal_category' => $this->getValueAt($sheet, $this->table['renewal_category'], $this->row),
                ]
        );

            $this->row++;
        
        }
    }
 
    private function getValueAt($sheet,$c, $r){
        return $sheet->getActiveSheet()->getCellByColumnAndRow($c,$r)->getValue();
    }
}
