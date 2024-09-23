<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipalityData extends Model
{
    use HasFactory;

        protected $fillable = [
            'COD_SLL_2011_2018', 'DEN_SLL_2011_2018', 'POP21', 'TPOP01_21', 'TPOP11_21', 'PST21',
            'VPST01_21', 'VPST11_21', 'PIS21', 'VPIS01_21', 'VPIS11_21', 'RedMed21', 'TRedMed01_21',
            'TRedMed11_21', 'Dis21', 'VDis11_21', 'AddLog21', 'TAddLog01_21', 'TAddLog11_21', 
            'XAdd_21', 'VXAdd_01_21', 'VXAdd_11_21', 'QLAdd_IT01', 'QLAdd_IT11', 'QLAdd_IT21', 
            'VQLAdd_IT01_21', 'VQLAdd_IT11_21', 'StCAT21', 'UIU13_21', 'Imm21', 'VImm13_21'
        ];
}
