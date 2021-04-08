<?php

declare(strict_types=1);

namespace App;

use App\Events\OrganisationCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organisation
 *
 * @property int         id
 * @property string name
 * @property int owner_user_id
 * @property Carbon trial_end
 * @property bool subscribed
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon|null deleted_at
 * @property User|null owner
 *
 * @package App
 * @method static filter(Http\Filters\OrganisationFilter|null $filter)
 * @method static find(int $int)
 */
class Organisation extends Model
{
    use SoftDeletes;
    use HasFilters;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'trial_end',
    ];

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => OrganisationCreated::class,
    ];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }
}
