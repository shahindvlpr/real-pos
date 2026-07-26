<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['key' => 'company_name', 'value' => 'Real POS', 'group' => 'general'],
            ['key' => 'company_address', 'value' => '123, Dhaka, Bangladesh', 'group' => 'general'],
            ['key' => 'company_phone', 'value' => '+8801700-000000', 'group' => 'general'],
            ['key' => 'company_email', 'value' => 'info@realpos.com', 'group' => 'general'],
            ['key' => 'invoice_prefix', 'value' => 'INV-', 'group' => 'invoice'],
            ['key' => 'invoice_footer', 'value' => 'Thank you for your purchase!', 'group' => 'invoice'],
            ['key' => 'invoice_terms', 'value' => 'Goods once sold will not be returned.', 'group' => 'invoice'],
            ['key' => 'default_tax', 'value' => '0', 'group' => 'tax'],
            ['key' => 'currency_symbol', 'value' => '৳', 'group' => 'general'],
            ['key' => 'low_stock_alert', 'value' => '10', 'group' => 'inventory'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}