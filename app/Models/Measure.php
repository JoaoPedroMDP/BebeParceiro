<?php
declare(strict_types=1);

namespace App\Models;

use App\Domains\Core\HidesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Measure
 * @package App\Models
 */
class Measure extends HidesTimestamps
{
    use HasFactory;
}
