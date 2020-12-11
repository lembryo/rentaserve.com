<?php


use App\Models\Domain;
use App\Models\Record;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentaserveSeeder extends Seeder
{
    public function run()
    {
        try {
            DB::beginTransaction();

            DB::table("domains")->truncate();
            DB::table("records")->truncate();

            $ip_address = env("IP_ADDRESS");
            $mail_address = env("MAIL_ADDRESS");
            $base = parse_url(config("app.url"), PHP_URL_HOST);

            $domain = Domain::make();
            $domain->name = $base;
            $domain->type = "NATIVE";
            $domain->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = $base;
            $record->content = "$base $mail_address 1";
            $record->type = "SOA";
            $record->ttl = 86400;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = $base;
            $record->content = "ns1.$mail_address";
            $record->type = "NS";
            $record->ttl = 86400;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = $base;
            $record->content = "n2.$mail_address";
            $record->type = "NS";
            $record->ttl = 86400;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = "$base";
            $record->content = $ip_address;
            $record->type = "A";
            $record->ttl = 3600;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = "ns1.$base";
            $record->content = $ip_address;
            $record->type = "A";
            $record->ttl = 3600;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = "ns2.$base";
            $record->content = $ip_address;
            $record->type = "A";
            $record->ttl = 3600;
            $record->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
