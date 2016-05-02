<?php

return [
    'Scripts' => [
        ['Name' => 'GREENPEACE UPGRADE',
            'Commentaire' => 'Appels sortants',
            'Version' => 1,
            'ControllerDirectory' => 'GP_Upgrade',
            'ControllerStart' => 'index',
            'Activities' => ['746c19aceb26444192a2a181828ea102'],
        ],
        ['Name' => 'GREENPEACE UPGRADE V2',
            'Commentaire' => 'Appels sortants v2',
            'Version' => 2,
            'ControllerDirectory' => 'GP_Upgrade',
            'ControllerStart' => 'index',
            'Activities' => ['f03aca45b54241259a62041b676fdb8a'],
        ],
        ['Name' => 'UNADEV FIDELISATION',
            'Commentaire' => 'Appels sortants - INACTIFS v1',
            'Version' => 1,
            'ControllerDirectory' => 'UNA_Fid',
            'ControllerStart' => 'index',
            'Activities' => ['e64d913cf18742a383a943b9e609810f'],
        ],
        ['Name' => 'UNADEV FIDELISATION',
            'Commentaire' => 'Appels sortants NOUVEAUX 1ER SEM P20 v1',
            'Version' => 1,
            'ControllerDirectory' => 'UNA_Fid',
            'ControllerStart' => 'index',
            'Activities' => ['4b7c2c39a1be4f5ba2c6d32ca068e3a9', '85e59850b5554d848f3154a99cc7b69a'],
        ],
        ['Name' => 'UNADEV FACTEURS',
            'Commentaire' => 'Appels sortants FACTEURS',
            'Version' => 1,
            'ControllerDirectory' => 'UNA_Fact',
            'ControllerStart' => 'index',
            'Activities' => ['1eda085380844a56b3efe3f594d8e900', '7380d7e0a2454340b4a9dc380740c3c4', 'c11e8abc677040f88436b0ad45ad935d', '6586c534b9164ae89c9f09490a231690', '4a86cd56aa7f4e4d8cfc52d0cc4229e1', 'cdfafba547a54ff7b134041b89559685'],
        ],
        ['Name' => 'GREENPEACE UPGRADE',
            'Commentaire' => 'Appels entrants',
            'Version' => 2,
            'ControllerDirectory' => 'GP_Upgrade',
            'ControllerStart' => 'search',
            'Activities' => ['88dadd136eab42f385bc3a8c314991d7'],
            'AutoSearch' => ['TEL1', 'TEL2'],
            'SearchFilter' => [],
            'IncomingQualificationError' => '3f236b09dfaa4de1bb6f3ed3293b34e3',
        ],
        ['Name' => 'GREENPEACE LEADS CARITATIFS',
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'GP_Leads',
            'ControllerStart' => 'index',
            'Activities' => ['d1340400746448499870ebd8ac46faff', '3039be8f58c94b4a93afcc338fdb1b42'],
        ],
        ['Name' => 'GREENPEACE PROSPECTION',
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'GP_Prosp',
            'ControllerStart' => 'index',
            'Activities' => ['c6dc05ea120e4d188ca62ebe0ee2bb24', '753d318bb0f24755b9bf8c7c6f59f578'],
        ],
        ['Name' => 'CHAINE DE L\'ESPOIR UPGRADE',
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'CHAINE_Upgrade',
            'ControllerStart' => 'index',
            'Activities' => ['dc58c49f46fc4fa4a36f0eb1b8f4fe09', 'c003376af5fa4c078cc2e9d401c227da'],
        ],
        ['Name' => 'CHAINE DE L\'ESPOIR REACT',
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'CHAINE_React',
            'ControllerStart' => 'index',
            'Activities' => ['8b65ba21a32141ef820096efe40407a9', '20d684f4f62644699f41aaebefcab7fa'],
        ],
        ['Name' => 'GREENPEACE REACTIVATION CYCLE 3',
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'GP_React',
            'ControllerStart' => 'index',
            'Activities' => ['144758f7846c45adb8e2efc3aa572aa1', '18d11b3622d246949ba9000c88eb9995'],
        ],
        ['Name' => 'LEADS BTOB',
            'Module' => 1,
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'Artisans',
            'ControllerStart' => 'index',
            'Activities' => ['84c8c73584364bdba8dbd733c72ec6cc', '97941fdff18b438e919aac8bcd41be9b'],
        ],
        ['Name' => 'LEADS TRAVAUX',
            'Module' => 1,
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'Travaux',
            'ControllerStart' => 'index',
            'Activities' => ['0e1f92aa557e4082b874ee51131f6340', 'aa56e8039c3e45eba01cda0a830a432c'],
        ],
        ['Name' => 'GREEENPEACE CYCLE 3',
            'Module' => 1,
            'Commentaire' => '',
            'Version' => 1,
            'ControllerDirectory' => 'GpCycle2',
            'ControllerStart' => 'index',
            'Activities' => ['d58ec5029f90417390b1d98fe7797a3e', 'e3e8540621c9416f9f0762c5e30fe6a9'],
        ],
    ],
];

