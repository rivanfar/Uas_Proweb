<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputData extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'input_datas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_input_proses_data',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function data_satus()
    {
        return $this->belongsToMany(DataSatu::class);
    }

    public function data_duas()
    {
        return $this->belongsToMany(DataDua::class);
    }

    public function data_tigas()
    {
        return $this->belongsToMany(DataTiga::class);
    }

    public function data_empats()
    {
        return $this->belongsToMany(DataEmpat::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
