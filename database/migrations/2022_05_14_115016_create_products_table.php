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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('product_name',50); 
            $table->string('product_slug',50);
            $table->string('product_code',100);
            $table->string('product_qty');
            $table->string('product_tags',100);
            $table->string('product_size',100)->nullable();
            $table->string('product_color',100);
            $table->string('selling_price');
            $table->string('discount_price');
            $table->string('product_thumbnail');
            $table->string('image_one');
            $table->string('image_two');
            $table->string('image_three');
            $table->longText('short_description');
            $table->longText('long_description')->nullable();
            $table->longText('key_features');
            $table->longText('specifications');
            $table->integer('hot_deals')->default(0);
            $table->integer('featured')->default(0);
            $table->integer('special_offer')->default(0);
            $table->integer('special_deals')->default(0);
            $table->string('product_creator')->default('Admin');
            $table->integer('product_status')->default(1);
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
        Schema::dropIfExists('products');
    }
};
