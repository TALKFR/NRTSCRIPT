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

