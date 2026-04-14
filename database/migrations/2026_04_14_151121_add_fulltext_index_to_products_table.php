<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE INDEX products_fulltext_search_idx
            ON products
            USING GIN (
                to_tsvector(
                    'simple',
                    coalesce(name,'') || ' ' ||
                    coalesce(description,'') || ' ' ||
                    coalesce(brand,'') || ' ' ||
                    coalesce(color,'')
                )
            )
        ");
    }

    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS products_fulltext_search_idx");
    }
};
