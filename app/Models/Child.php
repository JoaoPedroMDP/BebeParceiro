<?php
declare(strict_types=1);

namespace App\Models;

use App\Domains\Core\HidesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Child
 * @package App\Models
 */
class Child extends HidesTimestamps
{
    use HasFactory;
}
