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
        Schema::create('vacancy_replies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cv_id');
            $table->index('cv_id','idx_cv_vacancy_replies');
            $table->foreign('cv_id', 'fk_cv_vacancy_replies')->references('id')->on('c_v_s');

            $table->unsignedBigInteger('vacancy_id');
            $table->index('vacancy_id','idx_vacancy_replies_vacancy');
            $table->foreign('vacancy_id', 'fk_vacancy_replies_vacancy')->references('id')->on('vacancies');

            $table->timestamp('replied_at')->default(now());
            $table->string('covering_letter')->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_replies');
    }
};
