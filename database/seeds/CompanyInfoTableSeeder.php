<?php

use Illuminate\Database\Seeder;

class CompanyInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_company_info')->insert([
            'key'   => 'company',
            'value' => json_encode([
                'companyName'     => 'あくせるもおど',
                'companyTel'      => '09076603719',
                'companyMail'     => 'nakagawa@axcel-mode.co.jp',
                'companyZipcode'  => '1660003',
                'companyState'    => '東京都',
                'companyCity'     => '杉並区',
                'companyAddress1' => '高円寺南2',
                'companyAddress2' => '21-13'
            ], JSON_PRETTY_PRINT)
        ]);

        DB::table('mst_company_info')->insert([
            'key'   => 'job_category',
            'value' => json_encode([
                '0' => 'SE',
                '1' => 'PG'
            ], JSON_PRETTY_PRINT)
        ]);

        DB::table('mst_company_info')->insert([
            'key'   => 'post',
            'value' => json_encode([
                '0' => 'SL(サブリーダー)',
                '1' => 'PL(プロジェクトリーダー)',
                '2' => 'UL(ユニットリーダー)',
                '3' => 'M(マネージャー)',
                '4' => 'SM(シニアマネージャー)'
            ], JSON_PRETTY_PRINT)
        ]);

        DB::table('mst_company_info')->insert([
            'key'   => 'recruit',
            'value' => json_encode([
                '0' => '新卒',
                '1' => '中途'
            ], JSON_PRETTY_PRINT)
        ]);

        DB::table('mst_company_info')->insert([
            'key'   => 'employment_status',
            'value' => json_encode([
                '0' => '正社員',
                '1' => '派遣社員'
            ], JSON_PRETTY_PRINT)
        ]);

        DB::table('mst_company_info')->insert([
            'key'   => 'division',
            'value' => json_encode([
                '0' => 'R&D C1',
                '1' => 'R&D C2',
                '2' => 'R&D C3',
                '3' => 'R&D E1',
                '4' => 'R&D E2',
                '5' => 'R&D W1'
            ], JSON_PRETTY_PRINT)
        ]);
    }
}
