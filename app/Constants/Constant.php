<?php

namespace App\Constants;

class Constant
{
    // TASK_PRIORITY
    const TASK_PRIORITY_LOW    = 'LOW';
    const TASK_PRIORITY_MEDIUM = 'MEDIUM';
    const TASK_PRIORITY_HIGH   = 'HIGH';
    const TASK_PRIORITIES      = [
        self::TASK_PRIORITY_LOW,
        self::TASK_PRIORITY_MEDIUM,
        self::TASK_PRIORITY_HIGH,
    ];

    // TASK_STATUS
    const TASK_STATUS_TODO        = 'TODO';
    const TASK_STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const TASK_STATUS_DONE        = 'DONE';
    const TASK_STATUSES           = [
        self::TASK_STATUS_TODO,
        self::TASK_STATUS_IN_PROGRESS,
        self::TASK_STATUS_DONE,
    ];

    //PROJECT_STATUS
    const PROJECT_STATUS_ACTIVE    = 'ACTIVE';
    const PROJECT_STATUS_COMPLETED = 'COMPLETED';
    const PROJECT_STATUS_ARCHIVED  = 'ARCHIVED';
    const PROJECT_STATUSES         = [
        self::PROJECT_STATUS_ACTIVE,
        self::PROJECT_STATUS_COMPLETED,
        self::PROJECT_STATUS_ARCHIVED,
    ];
}
