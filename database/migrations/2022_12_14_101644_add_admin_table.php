<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('location')->nullable();
            $table->integer('admin_type')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        $pass = '12345678';

        \DB::table('admin_users')->insert([
           'name' => 'Super Admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make($pass),
           'admin_type' => 0,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
};
