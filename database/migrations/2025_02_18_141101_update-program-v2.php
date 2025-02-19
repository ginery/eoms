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
        if (!Schema::hasTable('programs')) {
            Schema::create('programs', function (Blueprint $table) {
                $table->id();
                $table->string('program_name');
                $table->text('program_desc');
                $table->longText('users_involve');
                $table->integer('added_by');
                $table->integer('is_approve')->default(0);
                $table->timestamps();
            });
        }else{
            Schema::table('programs', function (Blueprint $table) {
                // Check if the columns already exist before adding them
                if (!Schema::hasColumn('programs', 'program_name')) {
                    $table->string('program_name');
                }
                if (!Schema::hasColumn('programs', 'program_desc')) {
                    $table->text('program_desc');
                }
                if (!Schema::hasColumn('programs', 'users_involve')) {
                    $table->longText('users_involve');
                }
                if (!Schema::hasColumn('programs', 'is_approve')) {
                    $table->integer('is_approve');
                }  
                if (!Schema::hasColumn('programs', 'added_by')) {
                    $table->integer('added_by');
                }              
                if (!Schema::hasColumn('programs', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('programs', 'updated_at')) {
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
