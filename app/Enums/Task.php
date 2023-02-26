<?php

namespace App\Enums;

class Task extends Enum
{
    const PAGINATE = 25;
    const PENDING = 0;
    const IN_PROGRESS = 1;
    const COMPLETED = 2;
}
