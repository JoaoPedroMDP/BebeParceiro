<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBeneficiariesTable
 */
class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
			$table->string("birth");
			$table->integer("child_count");
			$table->boolean("is_pregnant");
			$table->string("marital_status");
			$table->float("familiar_income");
			$table->boolean("disabled");
			$table->boolean("approved");
			$table->foreignId("user_id")->constrained();
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
        Schema::dropIfExists('beneficiaries');
    }
}
