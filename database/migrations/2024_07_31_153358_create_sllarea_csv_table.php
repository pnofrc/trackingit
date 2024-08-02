<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_sllarea_csv_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSllareaCsvTable extends Migration
{
    public function up()
    {
        Schema::create('sllarea_csv', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file');
            $table->boolean('online')->default('false');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sllarea_csv');
    }
}
