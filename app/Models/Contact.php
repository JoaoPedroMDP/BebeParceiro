<?php
declare(strict_types=1);

namespace App\Models;

use App\Domains\Core\HidesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contact
 * @package App\Models
 */
class Contact extends HidesTimestamps
{
    use HasFactory;
}
