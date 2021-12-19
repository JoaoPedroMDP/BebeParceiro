<?php
declare(strict_types=1);

namespace App\Models;

use App\Domains\Core\HidesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SocialBenefit
 * @package App\Models
 */
class SocialBenefit extends HidesTimestamps
{
    use HasFactory;
}
