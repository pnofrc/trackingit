<?php
// database/migrations/YYYY_MM_DD_create_sll_area_data_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSllAreaDataTable extends Migration
{
    public function up()
    {
        Schema::create('sll_area_data', function (Blueprint $table) {
            $table->id();
            $table->string('COD_SLL_2011_2018');
            $table->string('DEN_SLL_2011_2018');
            $table->float('POP11');
            $table->float('PST11');
            $table->float('PD11');
            $table->float('RedMed11');
            $table->float('Dis11');
            $table->float('AddTot11');
            $table->float('AddLog11');
            $table->float('QLAdd_IT11');
            $table->float('ULTot11');
            $table->float('ULLog11');
            $table->float('AddULLog11');
            $table->float('QLUL_IT11');
            $table->float('PCSuolo12');
            $table->float('POP21');
            $table->float('TPOP11_21');
            $table->float('TSM11_21');
            $table->float('PST21');
            $table->float('VPST11_21');
            $table->float('PD21');
            $table->float('VPD11_21');
            $table->float('RedMed21');
            $table->float('TRedMed11_21');
            $table->float('Dis21');
            $table->float('VDis11_21');
            $table->float('AddTot21');
            $table->float('TAddTot11_21');
            $table->float('AddLog21');
            $table->float('TAddLog11_21');
            $table->float('QLAdd_IT21');
            $table->float('VQLAdd_IT11_21');
            $table->float('ULTot21');
            $table->float('TULTot11_21');
            $table->float('AddULTot21');
            $table->float('VAddULTot11_21');
            $table->float('ULLog21');
            $table->float('TULLog11_21');
            $table->float('AddULLog21');
            $table->float('VAddULLog11_21');
            $table->float('QLUL_IT21');
            $table->float('VQLUL_IT11_21');
            $table->float('PCSuolo21');
            $table->float('VPCSuolo11_21');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sll_area_data');
    }
}
