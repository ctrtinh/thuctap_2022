<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanPhamsTable extends Migration
{
    
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dungluong_id')->constrained('dungluong')->onDelete('cascade');
            // $table->foreignId('thuonghieu_id')->constrained('thuonghieu')->onDelete('cascade'); 
            $table->foreignId('thuonghieu_id')->references('id')->on('thuonghieu')->onUpdate('cascade');
            $table->foreignId('loai_id')->constrained('loai')->onDelete('cascade');
            $table->string('tensanpham');
            $table->string('tensanpham_slug');
            $table->integer('soluong');
            $table->double('dongia');
            $table->text('cauhinh')->nullable();
            $table->text('motasanpham')->nullable();
            $table->unsignedTinyInteger('hienthi')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('sanpham');
    }
}
