<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category');
            $table->foreignId('brand_id')->constrained('brand');
            $table->string('code', 150)->unique();
            $table->string('name', 58);
            $table->string('name_slug', 65);
            $table->string('image', 255);
            $table->string('thumb', 255);
            $table->double('unit_price');
            $table->double('price');
            $table->integer('import');
            $table->integer('exist');
            $table->tinyInteger('discount')->default(0);
            $table->string('summary', 255);
            $table->longText('description')->nullable();
            $table->string('video', 255)->nullable();
            $table->integer('num_of_review')->default(0);
            $table->integer('marks')->default(0);
            $table->string('approval', 3)->default('YES'); //YES, NO
            $table->string('status', 4)->default('show'); //show, hide
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
