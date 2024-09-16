<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            // Add the new 'amount' column
            $table->double('amount', 15, 2); // Adjust the precision and scale as needed

            // Rename the 'category' column to 'category_id'
            $table->renameColumn('category', 'category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            // Remove the 'amount' column
            $table->dropColumn('amount');

            // Rename the 'category_id' column back to 'category'
            $table->renameColumn('category_id', 'category');
        });
    }
};
