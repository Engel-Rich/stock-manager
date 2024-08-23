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
        Schema::create('categorie', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        DB::table('categorie')->insert([
            ['libelle' => 'Bricolage', 'description' => 'Tout ce qui concerne le bricolage'],
            ['libelle' => 'Informatique', 'description' => 'Tout ce qui concerne l\'informatique'],
            ['libelle' => 'Electronique', 'description' => 'Tout ce qui concerne l\'electronique'],                        
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie');
    }
};
