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
            $table->integer('COD_SLL_2011_2018');
            $table->string('DEN_SLL_2011_2018');
            $table->integer('POP11');
            $table->decimal('PST11', 10, 8);
            $table->decimal('PD11', 10, 8);
            $table->decimal('RedMed11', 10, 8);
            $table->decimal('Dis11', 10, 8);
            $table->integer('AddTot11');
            $table->integer('AddLog11');
            $table->decimal('QLAdd_IT11', 10, 8);
            $table->integer('ULTot11');
            $table->integer('ULLog11');
            $table->decimal('AddULLog11', 10, 8);
            $table->decimal('QLUL_IT11', 10, 8);
            $table->decimal('PCSuolo12', 10, 8);
            $table->integer('POP21');
            $table->decimal('TPOP11_21', 10, 8);
            $table->decimal('TSM11_21', 10, 8);
            $table->decimal('PST21', 10, 8);
            $table->decimal('VPST11_21', 10, 8);
            $table->decimal('PD21', 10, 8);
            $table->decimal('VPD11_21', 10, 8);
            $table->decimal('RedMed21', 10, 8);
            $table->decimal('TRedMed11_21', 10, 8);
            $table->decimal('Dis21', 10, 8);
            $table->decimal('VDis11_21', 10, 8);
            $table->integer('AddTot21');
            $table->decimal('TAddTot11_21', 10, 8);
            $table->integer('AddLog21');
            $table->decimal('TAddLog11_21', 10, 8);
            $table->decimal('QLAdd_IT21', 10, 8);
            $table->decimal('VQLAdd_IT11_21', 10, 8);
            $table->integer('ULTot21');
            $table->decimal('TULTot11_21', 10, 8);
            $table->decimal('AddULTot21', 10, 8);
            $table->decimal('VAddULTot11_21', 10, 8);
            $table->integer('ULLog21');
            $table->decimal('TULLog11_21', 10, 8);
            $table->decimal('AddULLog21', 10, 8);
            $table->decimal('VAddULLog11_21', 10, 8);
            $table->decimal('QLUL_IT21', 10, 8);
            $table->decimal('VQLUL_IT11_21', 10, 8);
            $table->decimal('PCSuolo21', 10, 8);
            $table->decimal('VPCSuolo11_21', 10, 8);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sll_area_data');
    }
}
