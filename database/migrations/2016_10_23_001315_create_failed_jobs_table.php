<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $collection) {
            $collection->increments('id');
            $collection->text('connection');
            $collection->text('queue');
            $collection->longText('payload');
            $collection->longText('exception');
            $collection->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}
