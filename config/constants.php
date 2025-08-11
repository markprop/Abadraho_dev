<?php

return [
    'SuperAdminRoleId' => -1021,
    'SuperAdminUserId' => 1,
    'PageLimit' => 50,
    'UserTypeIds' => [
        'SuperAdmin' => -10021,
        'Admin' => -10022,
        'Builder' => -10025,
        'WebSiteUser' => -10024,
        'Employee' => -10023,
    ],
    'CustomActivityLogs' => [
        'viewProject' => ['description' => 'View Project List', 'value' => 'viewProjectList'],
        'viewProjectDetails' => ['description' => 'View Project Detail', 'value' => 'viewProjectDetails'],
        'submitProjectDetailInquiry' => ['description' => 'Submit Project Detail Inquiry', 'value' => 'submitProjectDetailInquiry'],
        'compareProjectDetail' => ['description' => 'Compare Project Detail', 'value' => 'compareProjectDetail'],
    ],
    'ActivityLogsConversionIds' => [
        'viewPageId' => -10001,
        'submitPropertyInquiry' => -10002,
        'clickToCall' => -10003,
        'cutomizedPaymentPlan' => -10004,
        'downloadPdf' => -10005,
        'loggedInId' => -10006,
        'clickToCompareId' => -10007,
    ],
];
