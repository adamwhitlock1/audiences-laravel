<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiencesTable extends Migration {
    public function up()
    {
        Schema::create('audiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->index();
            $table->string('facebook_id', 25)->nullable();
            $table->string('odc_id', 10)->nullable();
            $table->string('name', 300)->index();
            $table->string('type', 10);
            $table->string('sla', 25)->nullable();
            $table->string('estimated_size', 25)->nullable()->index();
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
