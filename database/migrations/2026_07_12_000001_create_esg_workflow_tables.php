<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('employee')->after('password');
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name');
            $table->string('code')->unique();
            $table->string('head')->nullable();
            $table->foreignId('parent_department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->unsignedInteger('employee_count')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('department_id')->nullable()->after('role')->constrained('departments')->nullOnDelete();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('emission_factors', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->string('unit');
            $table->decimal('factor', 10, 4);
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('co2_factor', 10, 4)->default(0);
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('environmental_goals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('target', 12, 2);
            $table->date('deadline');
            $table->string('status')->default('planned');
            $table->timestamps();
        });

        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('pdf')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->unsignedInteger('xp')->default(0);
            $table->string('difficulty')->default('medium');
            $table->date('deadline')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('csr_activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->nullable();
            $table->unsignedInteger('points')->default(0);
            $table->date('activity_date')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('supplier');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->decimal('quantity', 12, 2);
            $table->date('entry_date');
            $table->timestamps();
        });

        Schema::create('manufacturing_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->decimal('units_produced', 12, 2);
            $table->decimal('electricity_used', 12, 2)->default(0);
            $table->decimal('fuel_used', 12, 2)->default(0);
            $table->date('entry_date');
            $table->timestamps();
        });

        Schema::create('expense_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('expense_type');
            $table->decimal('amount', 12, 2);
            $table->date('entry_date');
            $table->timestamps();
        });

        Schema::create('fleet_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('vehicle');
            $table->decimal('fuel_used', 12, 2);
            $table->decimal('distance', 12, 2);
            $table->string('driver');
            $table->date('entry_date');
            $table->timestamps();
        });

        Schema::create('carbon_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('source_type');
            $table->unsignedBigInteger('source_id');
            $table->string('source_name');
            $table->decimal('quantity', 12, 2);
            $table->decimal('emission_factor', 10, 4);
            $table->decimal('co2_emission', 12, 2);
            $table->date('transaction_date');
            $table->timestamps();
        });

        Schema::create('employee_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->string('activity_type');
            $table->unsignedBigInteger('activity_id');
            $table->string('activity_title');
            $table->string('status')->default('pending_approval');
            $table->string('proof_url')->nullable();
            $table->unsignedInteger('points')->default(0);
            $table->timestamps();
        });

        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('findings')->nullable();
            $table->unsignedTinyInteger('score')->default(80);
            $table->date('audit_date');
            $table->string('status')->default('open');
            $table->timestamps();
        });

        Schema::create('compliance_issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('audit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('severity')->default('medium');
            $table->string('status')->default('open');
            $table->timestamps();
        });

        Schema::create('department_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->decimal('environmental', 5, 2);
            $table->decimal('social', 5, 2);
            $table->decimal('governance', 5, 2);
            $table->decimal('department_total', 6, 2);
            $table->decimal('overall', 5, 2);
            $table->date('score_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department_scores');
        Schema::dropIfExists('compliance_issues');
        Schema::dropIfExists('audits');
        Schema::dropIfExists('employee_activities');
        Schema::dropIfExists('carbon_transactions');
        Schema::dropIfExists('fleet_entries');
        Schema::dropIfExists('expense_entries');
        Schema::dropIfExists('manufacturing_entries');
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('csr_activities');
        Schema::dropIfExists('challenges');
        Schema::dropIfExists('policies');
        Schema::dropIfExists('environmental_goals');
        Schema::dropIfExists('products');
        Schema::dropIfExists('emission_factors');
        Schema::dropIfExists('categories');
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('department_id');
        });
        Schema::dropIfExists('departments');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
