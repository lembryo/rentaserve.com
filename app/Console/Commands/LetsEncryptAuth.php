<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Models\Record;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LetsEncryptAuth extends Command
{
    protected $signature = "lets:auth";

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
                $record = Record::make();
                $record->domain_id = $domain->id;
                $record->type = "TXT";
                $record->name = "_acme-challenge.$domain->name";
                $record->content = "\"$validation\"";
                $record->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
