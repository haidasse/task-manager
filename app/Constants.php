<?php

namespace App\Constants;

class Constant
{
    
    // TASK_PRIORITY
    const TASK_PRIORITY_LOW    = 'low';
    const TASK_PRIORITY_MEDIUM = 'medium';
    const TASK_PRIORITY_HIGH   = 'high';
    const TASK_PRIORITIES      = [
        self::TASK_PRIORITY_LOW,
        self::TASK_PRIORITY_MEDIUM,
        self::TASK_PRIORITY_HIGH,
    ];

    // TASK_STATUS
    const TASK_STATUS_TODO        = 'todo';
    const TASK_STATUS_IN_PROGRESS = 'in_progress';
    const TASK_STATUS_DONE        = 'done';
    const TASK_STATUSES           = [
        self::TASK_STATUS_TODO,
        self::TASK_STATUS_IN_PROGRESS,
        self::TASK_STATUS_DONE,
    ];

    //PROJECT_STATUS
    const PROJECT_STATUS_ACTIVE    = 'active';
    const PROJECT_STATUS_COMPLETED = 'completed';
    const PROJECT_STATUS_ARCHIVED  = 'archived';
    const PROJECT_STATUSES         = [
        self::PROJECT_STATUS_ACTIVE,
        self::PROJECT_STATUS_COMPLETED,
        self::PROJECT_STATUS_ARCHIVED,
    ];
}
