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
        //El usuario de acceso la primnera para cada usuarios va ser su nombre
        //y su password la clave de reigstro uncio (CURP)
        Schema::create('user_management',function(Blueprint $table){
            $table->id();

            $table->string('curp', 18);
            $table->string('name');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('birthdate');
            $table->string('state');
            $table->string('city');
            $table->boolean('actived')->default(true);
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_management');
    }
};
