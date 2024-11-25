<?php namespace StDevs\Dom\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateGamesTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('stdevs_dom_games', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('platform')->nullable();
            $table->string('barcode')->nullable();
            $table->string('series')->nullable();
            $table->json('genres')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->string('description')->nullable();
            $table->string('rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('stdevs_dom_games');
    }
};
