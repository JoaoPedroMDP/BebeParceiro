<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBenefitedSocialBenefitTable
 */
class CreateBenefitedSocialBenefitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefited_social_benefit', function (Blueprint $table) {
            $table->id();
						$table->foreignId("benefited_id")->constrained();
						$table->foreignId("social_benefit_id")->constrained();
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
        Schema::dropIfExists('benefited_social_benefit');
    }
}
