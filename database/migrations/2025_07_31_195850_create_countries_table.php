<?php

use App\StatusEnum;
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
        Schema::create('countries', function (Blueprint $table) {
        $table->id();
            $table->string('alpha2_code', 2)->unique()->index();
            $table->string('alpha3_code', 3)->unique()->index();
            $table->string('english_name', 100);
            $table->string('arabic_name', 100)->nullable();
            $table->string('phone_code', 10)->nullable();
            $table->tinyInteger('status')->default(StatusEnum::Active->value);
            $table->timestamps();
            $table->softDeletes();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
