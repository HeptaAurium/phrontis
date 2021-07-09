<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->integer('classes_have_streams');
            $table->string('gender');
            $table->integer('manual_adm_no');
            $table->integer('school_has_branches');
            $table->string('logo_path');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE general_settings MODIFY COLUMN gender ENUM('both', 'male', 'female')");

        DB::table('general_settings')->insert([
            'id' => 1,
            'school_name' => 'School Name - Phrontis',
            'classes_have_streams' => 1,
            'gender' => 'both',
            'manual_adm_no' => 0,
            'school_has_branches' => 1,
            'logo_path' => "img/logo/phrontis.png",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
