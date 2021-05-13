<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Client
 *
 * @property integer $id
 * @property string $client_name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $country
 * @property double $latitude
 * @property double $longitude
 * @property string $phone_no1
 * @property string $phone_no2
 * @property string $zip
 * @property Carbon $start_validity
 * @property Carbon $end_validity
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 * @package App\Models
 */
class Client extends Model
{
    use HasFactory, SoftDeletes;

    // Client statuses
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    protected $table = 'clients';

    protected $perPage = 10;

    protected $fillable = [
        'client_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'phone_no1',
        'phone_no2',
        'zip',
        'start_validity',
        'end_validity',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }
}
