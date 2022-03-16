<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaiVietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baiviet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('chude_id')->constrained('chude')->onDelete('cascade');
            $table->text('tieude');
			$table->text('tieude_slug');
			$table->text('tomtat')->nullable();
			$table->text('noidung');
            $table->unsignedInteger('luotxem')->default(0);
            $table->unsignedInteger('binhluan')->default(0);
            $table->unsignedTinyInteger('kiemduyet')->default(0);
            $table->unsignedTinyInteger('hienthi')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baiviet');
    }
}
