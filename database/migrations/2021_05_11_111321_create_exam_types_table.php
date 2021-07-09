<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExamTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('out_of');
            $table->integer('class');
            $table->string('kind');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE exam_types MODIFY COLUMN kind ENUM('full', 'cat', 'endTerm')");

        $types = [
            ['name' => 'CAT I', 'code' => 'CTI', 'out_of' => '30', 'class' => 1, 'kind' => 'cat', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CAT II', 'code' => 'CTII',  'out_of' => '30', 'class' => 1, 'kind' => 'cat', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PAPER I', 'code' => 'PPI',  'out_of' => '80', 'class' => 1, 'kind' => 'full',  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PAPER II', 'code' => 'PPII', 'out_of' => '70', 'class' => 1, 'kind' => 'full', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PAPER III', 'code' => 'PPIII', 'out_of' => '70', 'class' => 1, 'kind' => 'full', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'End of Term', 'code' => 'EoT', 'out_of' => '70', 'class' => 1, 'kind' => 'endTerm', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('exam_types')->insert($types);

        Schema::create('exam_type_totals', function (Blueprint $table) {
            $table->id();
            $table->string('kind');
            $table->integer('out_of');
            $table->timestamps();
        });
        $data = [
            ['kind' => 'cat', 'out_of' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['kind' => 'endTerm', 'out_of' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['kind' => 'full', 'out_of' => 100, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('exam_type_totals')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_types');
    }
}
