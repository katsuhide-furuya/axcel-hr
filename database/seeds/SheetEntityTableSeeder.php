<?php

use Illuminate\Database\Seeder;

class SheetEntityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * $mergedGroup = array('valuators' => $request->add_valuators, 'evaluators' => $request->add_evaluators);
     * 
     * @return void
     */
    public function run()
    {
        DB::table('sheet_entity')->insert([
            'sheet_id'     => 1,
            'evaluatee_id' => 1,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => 'Laravel Masterするぞい',
                    'limitAndAchievement' => '4月まで',
                    'retrospective'       => 'まぁまぁ？',
                    'score'               => '32',
                    'inTarget'            => [
                        '0' => [
                            'target'        => 'アプリつくる',
                            'status'        => '継続',
                            'retrospective' => '進捗だめです',
                            'score'         => '32'
                        ]
                    ]
                ],
                '1' => [
                    'target'              => 'ULになるぞ',
                    'limitAndAchievement' => '6月',
                    'retrospective'       => '',
                    'score'               => '32',
                    'inTarget'            => [
                        '0' => [
                            'target'        => '立候補する',
                            'status'        => '完了',
                            'retrospective' => '進捗だめです',
                            'score'         => '32'
                        ],
                        '1' => [
                            'target'        => '50%以上の票を得る',
                            'status'        => '',
                            'retrospective' => '',
                            'score'         => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);

        DB::table('sheet_entity')->insert([
            'sheet_id'     => 1,
            'evaluatee_id' => 2,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '1' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);

        DB::table('sheet_entity')->insert([
            'sheet_id'     => 1,
            'evaluatee_id' => 3,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '1' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);

        DB::table('sheet_entity')->insert([
            'sheet_id'     => 1,
            'evaluatee_id' => 4,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '1' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);

        DB::table('sheet_entity')->insert([
            'sheet_id'     => 2,
            'evaluatee_id' => 1,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => '進捗1',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '1' => [
                    'target'              => '進捗2',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '進捗3',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '3' => [
                    'target'              => '進捗4',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '4' => [
                    'target'              => '進捗5',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '5' => [
                    'target'              => '進捗6',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);

        DB::table('sheet_entity')->insert([
            'sheet_id'     => 2,
            'evaluatee_id' => 2,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => '進捗1',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '1' => [
                    'target'              => '進捗2',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '進捗3',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '3' => [
                    'target'              => '進捗4',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '4' => [
                    'target'              => '進捗5',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '5' => [
                    'target'              => '進捗6',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);

        DB::table('sheet_entity')->insert([
            'sheet_id'     => 2,
            'evaluatee_id' => 3,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => '進捗1',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '1' => [
                    'target'              => '進捗2',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '進捗3',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '3' => [
                    'target'              => '進捗4',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '4' => [
                    'target'              => '進捗5',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '5' => [
                    'target'              => '進捗6',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);

        DB::table('sheet_entity')->insert([
            'sheet_id'     => 2,
            'evaluatee_id' => 4,
            'rater_id'     => 5,
            'objective'    => json_encode([
                '0' => [
                    'target'              => '進捗1',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '1' => [
                    'target'              => '進捗2',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '2' => [
                    'target'              => '進捗3',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '3' => [
                    'target'              => '進捗4',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '4' => [
                    'target'              => '進捗5',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ],
                '5' => [
                    'target'              => '進捗6',
                    'limitAndAchievement' => '',
                    'retrospective'       => '',
                    'score'               => '',
                    'inTarget'            => [
                        '0' => [
                            'target'         => '',
                            'status'         => '',
                            'retrospective'  => '',
                            'score'          => ''
                        ]
                    ]
                ]
            ], JSON_PRETTY_PRINT),
        ]);
    }
}
