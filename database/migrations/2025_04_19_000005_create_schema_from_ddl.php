<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemaFromDdl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // address table
        if (!Schema::hasTable('address')) {
            Schema::create('address', function (Blueprint $table) {
                $table->increments('id');
                $table->string('street', 999)->nullable();
                $table->string('number', 999)->nullable();
                $table->string('addition', 999)->nullable();
                $table->string('zipcode', 999)->nullable();
                $table->string('city', 999)->nullable();
                $table->string('country', 999)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // agreement table
        if (!Schema::hasTable('agreement')) {
            Schema::create('agreement', function (Blueprint $table) {
                $table->increments('id');
                $table->string('identifier', 8)->nullable();
                $table->integer('status')->nullable();
                $table->integer('employee')->nullable();
                $table->integer('student')->nullable();
                $table->integer('service')->nullable();
                $table->integer('plan')->default(1)->nullable();
                $table->float('hours')->default(0)->nullable();
                $table->integer('subject')->nullable();
                $table->integer('level')->nullable();
                $table->timestamp('start')->nullable();
                $table->timestamp('end')->nullable();
                $table->string('extension', 8)->nullable();
                $table->integer('preference_location')->default(1)->nullable();
                $table->integer('preference_group')->default(1)->nullable();
                $table->string('remark', 999)->nullable();
                $table->integer('evaluation')->nullable();
                $table->boolean('plan_reminder_sent')->default(false);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // announcement table
        if (!Schema::hasTable('announcement')) {
            Schema::create('announcement', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('role');
                $table->string('author', 999)->nullable();
                $table->string('title', 999);
                $table->text('body');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // area table
        if (!Schema::hasTable('area')) {
            Schema::create('area', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 999)->nullable();
                $table->string('city', 999)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // article table
        if (!Schema::hasTable('article')) {
            Schema::create('article', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug', 99)->nullable();
                $table->string('title', 999)->nullable();
                $table->string('subtitle', 999)->nullable();
                $table->string('quote', 999)->nullable();
                $table->string('intro', 999)->nullable();
                $table->string('paragraph_1', 999)->nullable();
                $table->string('body', 4999)->nullable();
                $table->integer('person')->nullable();
                $table->string('background', 99)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // customer table
        if (!Schema::hasTable('customer')) {
            Schema::create('customer', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // employee table
        if (!Schema::hasTable('employee')) {
            Schema::create('employee', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user')->nullable();
                $table->integer('area')->default(1)->nullable();
                $table->string('profile_text', 999)->nullable();
                $table->string('school_current', 999)->nullable();
                $table->string('education_current', 999)->nullable();
                $table->string('profile_current', 999)->nullable();
                $table->string('school_middelbare', 999)->nullable();
                $table->string('education_middelbare', 999)->nullable();
                $table->string('profile_middelbare', 999)->nullable();
                $table->string('motivation', 999)->nullable();
                $table->string('iban', 30)->nullable();
                $table->integer('capacity')->nullable();
                $table->timestamp('start_employment')->nullable();
                $table->string('cv', 99)->nullable();
                $table->string('diploma', 99)->nullable();
                $table->string('contract', 99)->nullable();
                $table->string('identificatie', 99)->nullable();
                $table->string('loonheffing', 99)->nullable();
                $table->string('indiensttreding', 99)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // evaluation table
        if (!Schema::hasTable('evaluation')) {
            Schema::create('evaluation', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key', 6)->nullable();
                $table->integer('host')->nullable();
                $table->integer('student')->nullable();
                $table->integer('address')->nullable();
                $table->timestamp('datetime')->nullable();
                $table->integer('regarding')->nullable();
                $table->text('location_text')->nullable();
                $table->text('link')->nullable();
                $table->text('remarks')->nullable();
                $table->json('answers')->nullable();
                $table->boolean('performed')->default(false)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // evaluation_employee table
        if (!Schema::hasTable('evaluation_employee')) {
            Schema::create('evaluation_employee', function (Blueprint $table) {
                $table->integer('evaluation')->nullable();
                $table->integer('employee')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['evaluation', 'employee'], 'evaluation_employee_pk');
            });
        }

        // level table
        if (!Schema::hasTable('level')) {
            Schema::create('level', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code', 20)->nullable();
                $table->string('name', 99)->nullable();
                $table->integer('year')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // location table
        if (!Schema::hasTable('location')) {
            Schema::create('location', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 999);
                $table->float('longitude')->nullable();
                $table->float('latitude')->nullable();
                $table->integer('type');
                $table->integer('address')->nullable();
                $table->integer('area')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // log table
        if (!Schema::hasTable('log')) {
            Schema::create('log', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user')->nullable();
                $table->string('action', 999)->nullable();
                $table->string('data', 999)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // person table
        if (!Schema::hasTable('person')) {
            Schema::create('person', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug', 999)->nullable();
                $table->string('first_name', 99)->nullable();
                $table->string('middle_name', 99)->nullable();
                $table->string('last_name', 99)->nullable();
                $table->string('prefix', 99)->nullable();
                $table->string('company', 199)->nullable();
                $table->dateTime('birth_date')->nullable();
                $table->string('refer', 999)->nullable();
                $table->string('phone', 999)->nullable();
                $table->string('avatar', 999)->nullable();
                $table->integer('address')->nullable();
                $table->string('social_instagram', 999)->nullable();
                $table->string('social_linkedin', 999)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // report table
        if (!Schema::hasTable('report')) {
            Schema::create('report', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user')->nullable();
                $table->integer('study')->nullable();
                $table->timestamp('start')->nullable();
                $table->timestamp('end')->nullable();
                $table->string('content_voortgang', 4999)->nullable();
                $table->string('content_volgende_les', 4999)->nullable();
                $table->string('content_uitdagingen', 4999)->nullable();
                $table->boolean('trial_succes')->default(false)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // report_subject table
        if (!Schema::hasTable('report_subject')) {
            Schema::create('report_subject', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('agreement')->nullable();
                $table->integer('subject')->nullable();
                $table->integer('report')->nullable();
                $table->float('duration')->nullable();
                $table->string('content_verslag', 4999)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // role table
        if (!Schema::hasTable('role')) {
            Schema::create('role', function (Blueprint $table) {
                $table->increments('id');
                $table->string('label', 999)->nullable();
                $table->string('label_public', 999)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // service table
        if (!Schema::hasTable('service')) {
            Schema::create('service', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 999);
                $table->string('short', 999)->nullable();
                $table->string('code', 999)->nullable();
                $table->float('rate_plan1_solo')->nullable();
                $table->float('rate_plan1_group')->nullable();
                $table->float('rate_plan2_solo')->nullable();
                $table->float('rate_plan2_group')->nullable();
                $table->float('rate_plan3_solo')->nullable();
                $table->float('rate_plan3_group')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // student table
        if (!Schema::hasTable('student')) {
            Schema::create('student', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user')->nullable();
                $table->integer('customer')->nullable();
                $table->string('school', 999)->nullable();
                $table->string('niveau', 999)->nullable();
                $table->integer('leerjaar')->nullable();
                $table->string('profile', 999)->nullable();
                $table->string('email_mentor', 199)->nullable();
                $table->string('email_vakdocent_1', 199)->nullable();
                $table->string('email_vakdocent_2', 199)->nullable();
                $table->string('email_vakdocent_3', 199)->nullable();
                $table->string('name_mentor', 199)->nullable();
                $table->string('name_vakdocent_1', 199)->nullable();
                $table->string('name_vakdocent_2', 199)->nullable();
                $table->string('name_vakdocent_3', 199)->nullable();
                $table->integer('branch')->default(1);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // study table
        if (!Schema::hasTable('study')) {
            Schema::create('study', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key', 6)->nullable();
                $table->integer('status')->nullable();
                $table->integer('service')->nullable();
                $table->integer('host_user')->nullable();
                $table->integer('host_relation')->nullable();
                $table->string('subject_text', 999)->nullable();
                $table->string('subject_description', 999)->nullable();
                $table->string('location_text', 999)->nullable();
                $table->integer('address')->nullable();
                $table->string('link', 999)->nullable();
                $table->timestamp('start')->nullable();
                $table->timestamp('end')->nullable();
                $table->boolean('trial')->default(false)->nullable();
                $table->integer('course')->nullable();
                $table->string('remark', 999)->nullable();
                $table->integer('reason_cancel')->nullable();
                $table->string('explanation_cancel', 999)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // study_participant table
        if (!Schema::hasTable('study_participant')) {
            Schema::create('study_participant', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('study')->nullable();
                $table->string('payment_reference', 999)->nullable();
                $table->boolean('payment_received')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // study_user table
        if (!Schema::hasTable('study_user')) {
            Schema::create('study_user', function (Blueprint $table) {
                $table->integer('study')->nullable();
                $table->integer('user')->nullable();
                $table->integer('agreement')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unique(['study', 'user'], 'study_user_pk');
            });
        }

        // subject table
        if (!Schema::hasTable('subject')) {
            Schema::create('subject', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code', 99)->nullable();
                $table->string('name', 999)->nullable();
                $table->string('banner', 99)->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unique('code', 'subject_code_uindex');
            });
        }

        // modify users table to match DDL
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'role')) {
                    $table->integer('role')->nullable()->after('email');
                }
                if (!Schema::hasColumn('users', 'status')) {
                    $table->integer('status')->nullable()->after('role');
                }
                if (!Schema::hasColumn('users', 'points')) {
                    $table->integer('points')->nullable()->after('status');
                }
                if (!Schema::hasColumn('users', 'activate_sent')) {
                    $table->timestamp('activate_sent')->nullable()->after('remember_token');
                }
                if (!Schema::hasColumn('users', 'activate_secret')) {
                    $table->string('activate_secret', 100)->nullable()->after('activate_sent');
                }
                if (!Schema::hasColumn('users', 'activate_reminder_1week')) {
                    $table->boolean('activate_reminder_1week')->default(false)->nullable()->after('activate_secret');
                }
                if (!Schema::hasColumn('users', 'activate_reminder_2week')) {
                    $table->boolean('activate_reminder_2week')->default(false)->nullable()->after('activate_reminder_1week');
                }
                if (!Schema::hasColumn('users', 'language')) {
                    $table->string('language', 10)->default('nl_NL')->nullable()->after('password');
                }
                if (!Schema::hasColumn('users', 'category')) {
                    $table->integer('category')->nullable()->after('language');
                }
                if (!Schema::hasColumn('users', 'activated')) {
                    $table->timestamp('activated')->nullable()->after('category');
                }
                if (!Schema::hasColumn('users', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject');
        Schema::dropIfExists('study_user');
        Schema::dropIfExists('study_participant');
        Schema::dropIfExists('study');
        Schema::dropIfExists('student');
        Schema::dropIfExists('service');
        Schema::dropIfExists('role');
        Schema::dropIfExists('report_subject');
        Schema::dropIfExists('report');
        Schema::dropIfExists('person');
        Schema::dropIfExists('log');
        Schema::dropIfExists('location');
        Schema::dropIfExists('level');
        Schema::dropIfExists('evaluation_employee');
        Schema::dropIfExists('evaluation');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('customer');
        Schema::dropIfExists('article');
        Schema::dropIfExists('area');
        Schema::dropIfExists('agreement');
        Schema::dropIfExists('address');
    }
}
