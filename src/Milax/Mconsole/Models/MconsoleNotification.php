<?php

namespace Milax\Mconsole\Models;

use Illuminate\Database\Eloquent\Model;

class MconsoleNotification extends Model
{
    protected $fillable = ['title', 'text', 'seen'];
}
