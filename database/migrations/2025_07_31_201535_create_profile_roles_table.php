<?php

use App\GenderEnum;
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
        Schema::create('profile_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('nationality_id')->constrained('countries');
            $table->string('first_name');
            $table->string('mid_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('national_no')->nullable()->unique();
            $table->string('IBAN')->unique();
            $table->string('document_type');
            $table->string('document_no')->unique();
            $table->string('document_file_url');
            $table->tinyInteger('status')->default(StatusEnum::Pending->value);
            $table->tinyInteger('gender');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_roles');
    }
};
