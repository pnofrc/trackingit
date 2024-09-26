<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('municipality_data', function (Blueprint $table) {
            $table->id();
            $table->string('PRO_COM')->nullable(); // codice, stringa
            $table->string('COMUNE')->nullable(); // denominazione, stringa
            $table->integer('POP21')->nullable(); // popolazione, intero
            $table->double('TPOP01_21')->nullable(); // numerico decimale
            $table->double('TPOP11_21')->nullable(); // numerico decimale
            $table->double('PST21')->nullable(); // numerico decimale
            $table->double('VPST01_21')->nullable(); // numerico decimale
            $table->double('VPST11_21')->nullable(); // numerico decimale
            $table->double('PIS21')->nullable(); // numerico decimale
            $table->double('VPIS01_21')->nullable(); // numerico decimale
            $table->double('VPIS11_21')->nullable(); // numerico decimale
            $table->double('RedMed21')->nullable(); // numerico decimale
            $table->double('TRedMed01_21')->nullable(); // numerico decimale
            $table->double('TRedMed11_21')->nullable(); // numerico decimale
            $table->double('Dis21')->nullable(); // numerico decimale
            $table->double('VDis11_21')->nullable(); // numerico decimale
            $table->double('AddLog21')->nullable(); // numerico decimale
            $table->double('TAddLog01_21')->nullable(); // numerico decimale
            $table->double('TAddLog11_21')->nullable(); // numerico decimale
            $table->double('XAdd_21')->nullable(); // numerico decimale
            $table->double('VXAdd_11_21')->nullable(); // numerico decimale
            $table->double('QLAdd_IT01')->nullable(); // numerico decimale
            $table->double('QLAdd_IT11')->nullable(); // numerico decimale
            $table->double('QLAdd_IT21')->nullable(); // numerico decimale
            $table->double('VQLAdd_IT01_21')->nullable(); // numerico decimale
            $table->double('VQLAdd_IT11_21')->nullable(); // numerico decimale
            $table->double('StCAT21')->nullable(); // numerico decimale (se si tratta di un valore numerico)
            $table->double('UIU13_21')->nullable(); // numerico decimale
            $table->double('Imm21')->nullable(); // numerico decimale
            $table->double('VImm13_21')->nullable(); // numerico decimale
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipality_data');
    }
};
