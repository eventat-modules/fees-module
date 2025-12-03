<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('price')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('fee_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('locale')->index();
            $table->unique(['fee_id', 'locale']);
            $table->foreign('fee_id')->references('id')->on('fees')->cascadeOnDelete();
        });

        Artisan::call('db:seed', [
            '--class' => 'FeeSeeder',
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_translations');
        Schema::dropIfExists('fees');
    }
};
