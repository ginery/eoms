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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('phone_number');
                $table->string('password');
                $table->integer('role');
                $table->string('notification_token');
                $table->text('program_assigned');
                $table->timestamps();
            });
        }else{
            Schema::table('users', function (Blueprint $table) {
                // Check if the columns already exist before adding them
                if (!Schema::hasColumn('users', 'first_name')) {
                    $table->string('first_name');
                }
                if (!Schema::hasColumn('users', 'last_name')) {
                    $table->string('last_name');
                }
                if (!Schema::hasColumn('users', 'email')) {
                    $table->string('email')->unique();
                }
                if (!Schema::hasColumn('users', 'phone_number')) {
                    $table->string('phone_number');
                }
                if (!Schema::hasColumn('users', 'password')) {
                    $table->string('password');
                }
                if (!Schema::hasColumn('users', 'role')) {
                    $table->integer('role');
                }
                if (!Schema::hasColumn('users', 'notification_token')) {
                    $table->string('notification_token');
                }
                if (!Schema::hasColumn('users', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('users', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }
            });
        }
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
};


//php artisan make:migration 2014_10_12_000000_create_users_table --table=users
