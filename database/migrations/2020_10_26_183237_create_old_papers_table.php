<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paper_category_id');
            $table->string('name');
            $table->string('creator_name');
            $table->string('paper_pdf');
            $table->string('language');
            $table->timestamps();

            $table->foreign('paper_category_id')->references('id')->on('paper_categories')->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('old_papers');
    }
}
