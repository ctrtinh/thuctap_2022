<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Loai;

class CreateLoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai', function (Blueprint $table) {
            $table->id();
            $table->string('tenloai');
            $table->string('tenloai_slug');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });
        Loai::create(['tenloai' => 'Camera trong nhà','tenloai_slug' => 'camera-trong-nha']);
        Loai::create(['tenloai' => 'Camera webcam','tenloai_slug' => 'camera-webcam']);
        Loai::create(['tenloai' => 'Camera hành trình','tenloai_slug' => 'camera-hanh-trinh']);
        Loai::create(['tenloai' => 'Camera ngoài trời','tenloai_slug' => 'camera-ngoai-troi']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loai');
    }
}
