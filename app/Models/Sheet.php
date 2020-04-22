<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    /**
     * 関連テーブル名
     * 
     * @var string
     */
    protected $table = 'sheets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'period_id', 'sheet_name', 'sheet_title', 'sheet_description',
        'sheet_kind', 'sheet_style', 'sheet_group', 'del_flg',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
