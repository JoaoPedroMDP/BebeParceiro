<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePregnanciesTable
 */
class CreatePregnanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnancies', function (Blueprint $table) {
            $table->id();
			$table->string("name")->nullable();
			$table->enum('sex',
				[
					"male", "female", "unknown"
				]
			);
			$table->boolean("risky_pregnancy");
			$table->string("birth_forecast");
			$table->string("weight_forecast");
			$table->foreignId("benefited_id")->constrained('beneficiaries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregnancies');
    }
}
