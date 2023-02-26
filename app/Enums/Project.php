<?php

namespace App\Enums;

class Project extends Enum
{
    const PAGINATE = 25;
    const PUBLIC = 0;
    const PRIVATE = 1;
    const PENDING = 0;
    const IN_PROGRESS = 1;
    const COMPLETED = 2;
    const PROJECT_LIST = 'projects_list_';
    const CACHE_TIME = 40000;
}
