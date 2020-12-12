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

            $ip = env("IP_ADDRESS");
            $mail = env("MAIL_ADDRESS");
            $host = parse_url(config("app.url"), PHP_URL_HOST);

            $domain = Domain::make();
            $domain->name = $host;
            $domain->type = "NATIVE";
            $domain->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = $host;
            $record->content = "$host $mail 1";
            $record->type = "SOA";
            $record->ttl = 86400;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = $host;
            $record->content = "ns1.$host";
            $record->type = "NS";
            $record->ttl = 86400;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = $host;
            $record->content = "ns2.$host";
            $record->type = "NS";
            $record->ttl = 86400;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = "$host";
            $record->content = $ip;
            $record->type = "A";
            $record->ttl = 3600;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = "ns1.$host";
            $record->content = $ip;
            $record->type = "A";
            $record->ttl = 3600;
            $record->save();

            $record = Record::make();
            $record->domain_id = $domain->id;
            $record->name = "ns2.$host";
            $record->content = $ip;
            $record->type = "A";
            $record->ttl = 3600;
            $record->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
