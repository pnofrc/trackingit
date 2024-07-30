<?php

// app/Models/SllAreaData.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SllAreaData extends Model
{
    use HasFactory;

    protected $fillable = [
        'COD_SLL_2011_2018', 'DEN_SLL_2011_2018', 'POP11', 'PST11', 'PD11', 'RedMed11', 'Dis11', 
        'AddTot11', 'AddLog11', 'QLAdd_IT11', 'ULTot11', 'ULLog11', 'AddULLog11', 'QLUL_IT11', 
        'PCSuolo12', 'POP21', 'TPOP11_21', 'TSM11_21', 'PST21', 'VPST11_21', 'PD21', 'VPD11_21', 
        'RedMed21', 'TRedMed11_21', 'Dis21', 'VDis11_21', 'AddTot21', 'TAddTot11_21', 'AddLog21', 
        'TAddLog11_21', 'QLAdd_IT21', 'VQLAdd_IT11_21', 'ULTot21', 'TULTot11_21', 'AddULTot21', 
        'VAddULTot11_21', 'ULLog21', 'TULLog11_21', 'AddULLog21', 'VAddULLog11_21', 'QLUL_IT21', 
        'VQLUL_IT11_21', 'PCSuolo21', 'VPCSuolo11_21'
    ];
}
