<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Utils\EmployeeFields;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $restriction = EmployeeFields::getRestriction();
        $maxStringLength = $restriction['maxStringLength'];
        $maxPhoneLength = $restriction['phoneLength'];
        $maxUrlLength = $restriction['maxUrlLength'];

        DB::statement('CREATE EXTENSION IF NOT EXISTS fuzzystrmatch');

        Schema::create('employees', function (Blueprint $table) use ($maxStringLength, $maxPhoneLength, $maxUrlLength) {
            $table->id();
            $table->string("name", $maxStringLength);
            $table->string("patronymic", $maxStringLength);
            $table->string("surname", $maxStringLength);
            $table->date("birthday");
            $table->string("position", $maxStringLength);
            $table->string("phone", $maxPhoneLength);
            $table->string("avatar_url", $maxUrlLength)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP EXTENSION IF EXISTS fuzzystrmatch');
        Schema::dropIfExists('employees');
    }
};
