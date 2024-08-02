<?php
namespace App\Imports;

use App\Models\SllAreaData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParsedDataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new SllAreaData([
            'COD_SLL_2011_2018' => $row['COD_SLL_2011_2018'],
            'DEN_SLL_2011_2018' => $row['DEN_SLL_2011_2018'],
            'POP11' => $row['POP11'],
            'PST11' => $row['PST11'],
            'PD11' => $row['PD11'],
            'RedMed11' => $row['RedMed11'],
            'Dis11' => $row['Dis11'],
            'AddTot11' => $row['AddTot11'],
            'AddLog11' => $row['AddLog11'],
            'QLAdd_IT11' => $row['QLAdd_IT11'],
            'ULTot11' => $row['ULTot11'],
            'ULLog11' => $row['ULLog11'],
            'AddULLog11' => $row['AddULLog11'],
            'QLUL_IT11' => $row['QLUL_IT11'],
            'PCSuolo12' => $row['PCSuolo12'],
            'POP21' => $row['POP21'],
            'TPOP11_21' => $row['TPOP11_21'],
            'TSM11_21' => $row['TSM11_21'],
            'PST21' => $row['PST21'],
            'VPST11_21' => $row['VPST11_21'],
            'PD21' => $row['PD21'],
            'VPD11_21' => $row['VPD11_21'],
            'RedMed21' => $row['RedMed21'],
            'TRedMed11_21' => $row['TRedMed11_21'],
            'Dis21' => $row['Dis21'],
            'VDis11_21' => $row['VDis11_21'],
            'AddTot21' => $row['AddTot21'],
            'TAddTot11_21' => $row['TAddTot11_21'],
            'AddLog21' => $row['AddLog21'],
            'TAddLog11_21' => $row['TAddLog11_21'],
            'QLAdd_IT21' => $row['QLAdd_IT21'],
            'VQLAdd_IT11_21' => $row['VQLAdd_IT11_21'],
            'ULTot21' => $row['ULTot21'],
            'TULTot11_21' => $row['TULTot11_21'],
            'AddULTot21' => $row['AddULTot21'],
            'VAddULTot11_21' => $row['VAddULTot11_21'],
            'ULLog21' => $row['ULLog21'],
            'TULLog11_21' => $row['TULLog11_21'],
            'AddULLog21' => $row['AddULLog21'],
            'VAddULLog11_21' => $row['VAddULLog11_21'],
            'QLUL_IT21' => $row['QLUL_IT21'],
            'VQLUL_IT11_21' => $row['VQLUL_IT11_21'],
            'PCSuolo21' => $row['PCSuolo21'],
            'VPCSuolo11_21' => $row['VPCSuolo11_21'],
        ]);
    }
}
