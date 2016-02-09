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
        ['Name' => 'GREENPEACE UPGRADE',
            'Commentaire' => 'Appels entrants',
            'Version' => 1,
            'ControllerDirectory' => 'GP_Upgrade',
            'ControllerStart' => 'search',
            'Activities' => ['e98c302ee2464f19bc4075c6841dc8b1'],
            'AutoSearch' => ['tel3', 'tel_trouve'],
            'SearchFilter' => ['code_media' => 'K12T18'],
            'IncomingQualificationError' => 'aad81f62934b418597e80ab8ebe361a7',
        ],
    ],
];

