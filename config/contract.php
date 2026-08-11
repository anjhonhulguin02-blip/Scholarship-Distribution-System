<?php

return [
    'abi' => json_decode(file_get_contents(storage_path('contract_abi.json')), true)
];
