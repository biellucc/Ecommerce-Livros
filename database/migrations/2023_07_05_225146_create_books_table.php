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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('summary');
            $table->integer('pages');
            $table->string('author', 80);
            $table->integer('amount');
            $table->decimal('value', 10,2);
            $table->string('isbn13', '18');
            $table->string('language', '20');
            $table->integer('edition');
            $table->string('publishing_company', '80');
            $table->string('dimension', '10');
            $table->date('publication_date');
            $table->integer('parental_rating');
            $table->string('type', '9');
            $table->string('image');
            $table->foreignId('vendor_id')->constrained('vendors');
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
        Schema::dropIfExists('books');
    }
};
