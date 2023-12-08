<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('salary');

            $table->unsignedBigInteger('category_id');
            $table->index('category_id','idx_vacancy_category');
            $table->foreign('category_id', 'fk_vacancy_category')->references('id')->on('categories');

            $table->unsignedBigInteger('employment_type_id');
            $table->index('employment_type_id','idx_vacancy_employment_type');
            $table->foreign('employment_type_id', 'fk_vacancy_employment_type')->references('id')->on('employment_types');

            $table->string('responsibility');
            $table->string('requirements');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
