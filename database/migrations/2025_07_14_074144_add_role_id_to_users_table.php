<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_add_role_id_to_users_table.php
public function up()
{
    // Schema::table('users', function (Blueprint $table) {
    //     $table->foreignId('role_id')->constrained()->default(5); // 5 = client
    // });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
