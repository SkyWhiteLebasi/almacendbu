<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('num_orden');
            $table->string('nombre_pr');
            $table->string('foto')->nullable();
            $table->integer('stock');
            $table->integer('inicial')->nullable();
            $table->text('desc_pr')->nullable();
            $table->unsignedBigInteger('medida_id')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();

            $table->foreign('medida_id')->references('id')->on('medidas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
