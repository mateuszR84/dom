<?php namespace StDevs\Dom\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateItemsTable Migration
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
        Schema::create('stdevs_dom_albums', function(Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug');
            $table->text('artist');
            $table->text('barcode')->nullable();
            $table->json('genres')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->string('description')->nullable();
            $table->text('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('stdevs_dom_albums');
    }
};
