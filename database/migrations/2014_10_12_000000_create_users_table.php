<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 100)->unique(); // Tên đăng nhập
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('role', 20)->default('user'); // Quyền hạn: admin, user
            $table->tinyInteger('kichhoat')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });

        User::create([
			'name' => 'Administrator',
			'username' => 'admin',
			'email' => 'camerastore@gmail.com',
            'email_verified_at' => Carbon::now(),
			'password' => '$2y$10$OZ5YFT7m2IQBEmQyf9B5K.yUER247wUgDi9t0mfnljdDie2Do.GuC', // 123456789
			'role' => 'admin',
		]);
        User::create([
			'name' => 'user',
			'username' => 'user',
			'email' => 'user@gmail.com',
            'email_verified_at' => Carbon::now(),
			'password' => '$2y$10$OZ5YFT7m2IQBEmQyf9B5K.yUER247wUgDi9t0mfnljdDie2Do.GuC', // 123456789
			'role' => 'staff',
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
