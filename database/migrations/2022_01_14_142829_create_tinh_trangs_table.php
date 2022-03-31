<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TinhTrang;

class CreateTinhTrangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinhtrang', function (Blueprint $table) {
            $table->id();
            $table->string('tinhtrang');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });

         // this is right
         TinhTrang::create(['tinhtrang' => 'Mới']);
         TinhTrang::create(['tinhtrang' => 'Đang xác nhận / Đã xác nhận']);
         TinhTrang::create(['tinhtrang' => 'Đã hủy']);
         TinhTrang::create(['tinhtrang' => 'Đang đóng gói sản phẩm']);
         TinhTrang::create(['tinhtrang' => 'Chờ đi nhận / Đang đi nhận / Đã nhận hàng ']);
         TinhTrang::create(['tinhtrang' => 'Đang chuyển']);
         TinhTrang::create(['tinhtrang' => 'Thất bại']);
         TinhTrang::create(['tinhtrang' => 'Đang chuyển hoàn']);
         TinhTrang::create(['tinhtrang' => 'Đã chuyển hoàn ']);
         TinhTrang::create(['tinhtrang' => 'Thành công']);
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tinhtrang');
    }
}
