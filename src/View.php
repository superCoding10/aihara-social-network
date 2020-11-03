<?php
declare(strict_types=1);

namespace Aihara;

use InvalidArgumentException;

class View {

    

    public function __construct($path, ?array $data = null) {
        $path = '../resources/view/' . (substr($path, -3) !== 'php' ? $path . '.php' : $path);
        if(!file_exists($path)) {
            throw new InvalidArgumentException('view does not exists');
        }

        if(is_array($data)) {
            foreach($data as $key => $value) {
                $this->$key = $value;
            }
        }
        require $path;
    }
}