<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DungLuong;
class CreateDungLuongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dungluong', function (Blueprint $table) {
            $table->id();
            $table->string('dungluong');
            $table->string('dungluong_slug');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });
        DungLuong::create(['dungluong' => '32 GB','dungluong_slug' => '32-gb']);
        DungLuong::create(['dungluong' => '64 GB','dungluong_slug' => '64-gb']);
        DungLuong::create(['dungluong' => '128 GB','dungluong_slug' => '128-gb']);
        DungLuong::create(['dungluong' => '256 GB','dungluong_slug' => '256-gb']);
        DungLuong::create(['dungluong' => '512 GB','dungluong_slug' => '512-gb']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dungluong');
    }
}
