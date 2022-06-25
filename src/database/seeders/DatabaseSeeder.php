<?php

use Database\Seeders\InvoiceStandardBodyHeader;
use Database\Seeders\InvoiceStandardFooter;
use Database\Seeders\InvoiceStandardHeader;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InvoiceStandardHeader::class,
            InvoiceStandardBodyHeader::class,
            InvoiceStandardFooter::class,
        ]);
    }
}
