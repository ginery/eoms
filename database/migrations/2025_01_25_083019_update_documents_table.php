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
        if (!Schema::hasTable('documents')) {
            Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->string('document_name')->nullable();
                $table->string('document_type')->nullable();
                $table->integer('document_size')->nullable();
                $table->text('description')->nullable();
                $table->dateTime('date_added')->useCurrent();
                $table->integer('status')->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('path')->nullable();
                $table->integer('doc_path')->default(0);
                $table->integer('assigned_leader')->default(0);
                $table->longText('users_involved')->default(0);
                $table->timestamps();
                
            });
        }else{
            Schema::table('documents', function (Blueprint $table) {
                // Check if the columns already exist before adding them
                if (!Schema::hasColumn('documents', 'document_name')) {
                    $table->string('document_name')->nullable();
                }
                if (!Schema::hasColumn('documents', 'document_type')) {
                    $table->string('document_type')->nullable();
                }
                if (!Schema::hasColumn('documents', 'document_size')) {
                    $table->integer('document_size')->nullable();
                }
                if (!Schema::hasColumn('documents', 'description')) {
                    $table->text('description')->nullable();
                }
                if (!Schema::hasColumn('documents', 'date_added')) {
                    $table->dateTime('date_added')->useCurrent();
                }
                if (!Schema::hasColumn('documents', 'status')) {
                    $table->integer('status')->nullable();
                }
                if (!Schema::hasColumn('documents', 'user_id')) {
                    $table->integer('user_id')->nullable();
                }
                if (!Schema::hasColumn('documents', 'path')) {
                    $table->integer('path')->nullable();
                }    
                if (!Schema::hasColumn('documents', 'doc_path')) {
                    $table->integer('doc_path')->default(0);
                }  
                if (!Schema::hasColumn('documents', 'assigned_leader')) {
                    $table->integer('assigned_leader')->default(0);
                }  
                if (!Schema::hasColumn('documents', 'users_involved')) {
                    $table->longText('users_involved')->default(0);
                }
                if (!Schema::hasColumn('documents', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('documents', 'updated_at')) {
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
