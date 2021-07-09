<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $counties = [
            ['name' => 'Mombasa'],
            ['name' =>'Kwale'], ['name' =>
            'Kilifi'], ['name' =>
            'Tana River'], ['name' =>
            'Lamu'], ['name' =>
            'Taita-Taveta'], ['name' =>
            'Garissa'], ['name' =>
            'Wajir'], ['name' =>
            'Mandera'], ['name' =>
            'Marsabit'], ['name' =>
            'Isiolo'], ['name' =>
            'Meru'], ['name' =>
            'Tharaka-Nithi'], ['name' =>
            'Embu'], ['name' =>
            'Kitui'], ['name' =>
            'Machakos'], ['name' =>
            'Makueni'], ['name' =>
            'Nyandarua'], ['name' =>
            'Nyeri'], ['name' =>
            'Kirinyaga'], ['name' =>
            'Muranga'], ['name' =>
            'Kiambu'], ['name' =>
            'Turkana'], ['name' =>
            'West Pokot'], ['name' =>
            'Samburu'], ['name' =>
            'Trans-Nzoia'], ['name' =>
            'Uasin Gishu'], ['name' =>
            'Elgeyo-Marakwet'], ['name' =>
            'Nandi'], ['name' =>
            'Baringo'], ['name' =>
            'Laikipia'], ['name' =>
            'Nakuru'], ['name' =>
            'Narok'], ['name' =>
            'Kajiado'], ['name' =>
            'Kericho'], ['name' =>
            'Bomet'], ['name' =>
            'Kakamega'], ['name' =>
            'Vihiga'], ['name' =>
            'Bungoma'], ['name' =>
            'Busia'], ['name' =>
            'Siaya'], ['name' =>
            'Kisumu'], ['name' =>
            'Homa Bay'], ['name' =>
            'Migori'], ['name' =>
            'Kisii'], ['name' =>
            'Nyamira'], ['name' =>
            'Nairobi']
        ];

        DB::table('counties')->insert($counties);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counties');
    }
}
