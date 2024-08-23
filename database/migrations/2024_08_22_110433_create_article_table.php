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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('description');            
            $table->double('prix_achat_unitaire');            
            $table->double('prix_vente_unitaire');            
            $table->double('qantite_par_lot')->nullable();            
            $table->double('prix_achat_par_lot')->nullable();                        
            $table->double('prix_vente_par_lot')->nullable();  
            $table->foreignId('categorie_id')->constrained('categorie')->onDelete('cascade')->onUpdate('cascade');                      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
};
