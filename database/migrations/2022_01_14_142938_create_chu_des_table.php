<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ChuDe;

class CreateChuDesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chude', function (Blueprint $table) {
            $table->id();
            $table->string('tenchude');
            $table->string('tenchude_slug');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });
        ChuDe::create(['tenchude' => 'Tin công nghệ','tenchude_slug' => 'tin-cong-nghe']);
        ChuDe::create(['tenchude' => 'Đánh giá','tenchude_slug' => 'danh-gia']);
        ChuDe::create(['tenchude' => 'Khuyến mãi','tenchude_slug' => 'khuyen-mai']);
        ChuDe::create(['tenchude' => 'Mẹo hay','tenchude_slug' => 'meo-hay']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chude');
    }
}
