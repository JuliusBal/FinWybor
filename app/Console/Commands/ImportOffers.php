<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SimpleXMLElement;

class ImportOffers extends Command
{
    protected $signature = 'offers:import {path} {--format=csv} {--source=direct}';
    protected $description = 'Import offers from CSV or XML into the offers table.';

    public function handle()
    {
        $path   = $this->argument('path');
        $format = strtolower($this->option('format'));
        $source = $this->normalizeNetwork($this->option('source'));

        if (!file_exists($path)) {
            $this->error("File not found: $path");
            return 1;
        }

        $rows = match ($format) {
            'csv' => $this->readCsv($path),
            'xml' => $this->readXml($path),
            default => (function () { $this->error('Unsupported format. Use csv|xml'); return []; })(),
        };
        if (empty($rows)) {
            $this->warn('No rows to import.');
            return 0;
        }

        $count = 0;

        foreach ($rows as $r) {
            $providerName = trim((string)($r['provider'] ?? 'Direct')) ?: 'Direct';
            $providerSlugFromRow = isset($r['provider_slug']) ? Str::slug((string)$r['provider_slug']) : null;

            $providerQuery = DB::table('providers');
            if ($providerSlugFromRow) {
                $provider = (clone $providerQuery)->where('slug', $providerSlugFromRow)->first();
            } else {
                $provider = (clone $providerQuery)->where('name', $providerName)->first();
            }

            if (!$provider) {
                $slug = $providerSlugFromRow ?: $this->uniqueProviderSlug($providerName);

                $providerId = DB::table('providers')->insertGetId([
                    'name'              => $providerName,
                    'slug'              => $slug,
                    'network'           => $source,
                    'website_url'       => $this->val($r, ['website_url', 'website']),
                    'tracking_template' => null,
                    'status'            => 'active',
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);

                $provider = (object)['id' => $providerId, 'name' => $providerName, 'slug' => $slug];
            } else {
                if (empty($provider->slug)) {
                    $newSlug = $providerSlugFromRow ?: $this->uniqueProviderSlug($providerName, $provider->id);
                    DB::table('providers')->where('id', $provider->id)->update([
                        'slug' => $newSlug,
                        'updated_at' => now(),
                    ]);
                    $provider->slug = $newSlug;
                }
            }

            $providerId = $provider->id;

            $brand  = trim((string)($r['brand'] ?? $r['name'] ?? 'Unknown'));
            $ptype  = strtolower((string)($r['product_type'] ?? 'loan'));
            if (!in_array($ptype, ['loan','card','insurance'], true)) {
                $ptype = 'loan';
            }

            $payload = [
                'provider_id'       => $providerId,
                'offer_code'        => $r['offer_code'] ?? null,
                'brand'             => $brand,
                'product_type'      => $ptype,
                'currency'          => $r['currency'] ?? 'PLN',
                'rrso'              => self::numOrNull($r['rrso'] ?? null),

                'amount_min'        => (int)($r['amount_min'] ?? 100),
                'amount_max'        => (int)($r['amount_max'] ?? 5000),
                'term_min_months'   => (int)($r['term_min'] ?? $r['term_min_months'] ?? 1),
                'term_max_months'   => (int)($r['term_max'] ?? $r['term_max_months'] ?? 12),
                'interest_type'     => $r['interest_type'] ?? 'annuity',
                'monthly_rate'      => self::numOrNull($r['monthly_rate'] ?? null),
                'setup_fee'         => self::numOrNull($r['setup_fee'] ?? null),
                'bik_check'         => self::boolOr($r['bik_check'] ?? true),
                'payout_speed'      => self::mapPayoutSpeed($r['payout_speed'] ?? null),
                'first_loan_free'   => self::boolOr($r['first_loan_free'] ?? false),
                'eligibility_notes' => $r['eligibility_notes'] ?? null,

                'annual_fee'        => self::numOrNull($r['annual_fee'] ?? null),
                'grace_days'        => isset($r['grace_days']) && $r['grace_days'] !== '' ? (int)$r['grace_days'] : null,
                'cashback_pct'      => self::numOrNull($r['cashback_pct'] ?? null),
                'welcome_bonus'     => $r['welcome_bonus'] ?? null,

                'insurance_kind'    => $r['insurance_kind'] ?? null,
                'premium_from'      => self::numOrNull($r['premium_from'] ?? null),

                'tracking_url'      => $r['tracking_url'] ?? null,
                'status'            => $r['status'] ?? 'active',
                'source'            => $source,
                'updated_at'        => now(),
            ];

            if ($ptype !== 'loan') {
                unset(
                    $payload['amount_min'], $payload['amount_max'],
                    $payload['term_min_months'], $payload['term_max_months'],
                    $payload['interest_type'], $payload['monthly_rate'],
                    $payload['setup_fee'], $payload['bik_check'],
                    $payload['payout_speed'], $payload['first_loan_free'],
                    $payload['eligibility_notes']
                );
            }
            if ($ptype !== 'card') {
                unset(
                    $payload['annual_fee'], $payload['grace_days'],
                    $payload['cashback_pct'], $payload['welcome_bonus']
                );
            }
            if ($ptype !== 'insurance') {
                unset(
                    $payload['insurance_kind'], $payload['premium_from']
                );
            }

            $existing = DB::table('offers')
                ->where('provider_id', $providerId)
                ->where('brand', $brand)
                ->where('product_type', $ptype)
                ->first();

            if ($existing) {
                DB::table('offers')->where('id', $existing->id)->update($payload);
            } else {
                $payload['created_at'] = now();
                DB::table('offers')->insert($payload);
            }

            $count++;
        }

        Cache::tags(['offers'])->flush();
        $this->info("Imported/updated $count offers from $format file.");
        return 0;
    }

    private function normalizeNetwork(?string $v): string
    {
        $v = strtolower(trim((string)$v));
        return in_array($v, ['awin','admitad','cju','direct','convertiser','other'], true) ? $v : 'other';
    }

    private function val(array $row, array $keys, $default = null)
    {
        foreach ($keys as $k) {
            if (isset($row[$k]) && $row[$k] !== '') return $row[$k];
        }
        return $default;
    }

    private function uniqueProviderSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'provider';
        $slug = $base;
        $i = 2;

        while (
        DB::table('providers')
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }
        return $slug;
    }

    private static function numOrNull($v)
    {
        if ($v === null || $v === '') return null;
        return (float) str_replace(',', '.', (string)$v);
    }

    private static function boolOr($v, $default=false)
    {
        if (is_null($v) || $v === '') return $default;
        if (is_bool($v)) return $v;
        $s = strtolower((string)$v);
        return in_array($s, ['1','true','yes','y','tak','si','oui'], true);
    }

    private function readCsv(string $path): array
    {
        $rows = [];
        $fh = fopen($path, 'r');
        if (!$fh) return $rows;
        $headers = null;
        while (($data = fgetcsv($fh, 0, ',')) !== false) {
            if ($headers === null) {
                $headers = array_map(fn($h) => strtolower(trim($h)), $data);
                continue;
            }
            $row = [];
            foreach ($headers as $i => $h) {
                $row[$h] = $data[$i] ?? null;
            }
            $rows[] = $row;
        }
        fclose($fh);
        return $rows;
    }

    private function readXml(string $path): array
    {
        $xml = new SimpleXMLElement(file_get_contents($path));
        $rows = [];
        foreach ($xml->offer as $o) {
            $row = [];
            foreach ($o->children() as $k => $v) {
                $row[strtolower($k)] = (string)$v;
            }
            $rows[] = $row;
        }
        return $rows;
    }

    private static function mapPayoutSpeed($v): ?string
    {
        if ($v === null) return null;
        $s = strtolower(trim((string)$v));
        if ($s === '') return null;

        $map = [
            'instant'      => 'instant',
            'instantly'    => 'instant',
            'same_day'     => 'same_day',
            'same-day'     => 'same_day',
            'same day'     => 'same_day',
            '1_3_days'     => '1_3_days',
            '1-3_days'     => '1_3_days',
            '1-3 days'     => '1_3_days',
            '1–3 days'     => '1_3_days',
            '1 to 3 days'  => '1_3_days',
            'other'        => 'other',
        ];

        return $map[$s] ?? null;
    }
}
