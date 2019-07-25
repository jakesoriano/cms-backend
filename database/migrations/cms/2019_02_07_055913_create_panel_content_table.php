<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('cms_db')->create('panel_content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_panel_id')->references('id')->on('page_panel');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('bg_color')->nullable();
            $table->json('content')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panel_content');
    }
}
