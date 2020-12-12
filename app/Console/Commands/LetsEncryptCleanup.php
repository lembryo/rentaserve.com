<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Models\Record;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LetsEncryptCleanup extends Command
{
    protected $signature = "lets:cleanup";

    protected $description = "Let's Encrypt";

    public function handle(): void
    {
        $domain = getenv("CERTBOT_DOMAIN");
        $validation = getenv("CERTBOT_VALIDATION");
        if ($domain === false || $validation === false) {
            return ;
        }

        try {
            DB::beginTransaction();

            $domain = Domain::select()
                ->where("name", $domain)
                ->first();
            if (!is_null($domain)) {
                $records = Record::select()
                    ->where("domain_id", $domain->id)
                    ->where("name", "_acme-challenge.$domain->name")
                    ->get();
                foreach ($records as $record) {
                    $record->delete();
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
