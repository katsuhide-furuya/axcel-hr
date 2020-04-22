<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SheetEntity extends Model
{
    /**
     * 関連テーブル名
     * 
     * @var string
     */
    protected $table = 'sheet_entity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sheet_id', 'evaluatee_id', 'rater_id', 'objective',
        'total_progress', 'total_score', 'status', 'del_flg',
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

    public function evaluatee() {
        return $this->belongsTo('App\Models\UserInfo', 'evaluatee_id', 'id');
    }

    public function rater() {
        return $this->belongsTo('App\Models\UserInfo', 'rater_id', 'id');
    }

    public function sheet() {
        return $this->belongsTo('App\Models\Sheet', 'sheet_id', 'id');
    }
}
