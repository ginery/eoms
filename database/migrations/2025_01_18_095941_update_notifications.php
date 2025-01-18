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
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('content');
                $table->integer('user_id');
                $table->integer('added_by');
                $table->string('project_status');
                $table->integer('is_seen')->default(0);
                $table->integer('is_seen_admin')->default(0);
                $table->timestamps();
            });
        }else{
            Schema::table('notifications', function (Blueprint $table) {
                // Check if the columns already exist before adding them
                if (!Schema::hasColumn('notifications', 'title')) {
                    $table->string('title');
                }
                if (!Schema::hasColumn('notifications', 'content')) {
                    $table->string('content');
                }
                if (!Schema::hasColumn('notifications', 'user_id')) {
                    $table->integer('user_id');
                }
                if (!Schema::hasColumn('notifications', 'added_by')) {
                    $table->integer('added_by');
                }
                if (!Schema::hasColumn('notifications', 'project_status')) {
                    $table->string('project_status');
                }
                if (!Schema::hasColumn('notifications', 'is_seen')) {
                    $table->integer('is_seen')->default(0);
                }
                if (!Schema::hasColumn('notifications', 'is_seen_admin')) {
                    $table->integer('is_seen_admin')->default(0);
                }    
                if (!Schema::hasColumn('notifications', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('notifications', 'updated_at')) {
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
        //
    }
};
