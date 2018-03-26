<?php

/**
  * Enum
  * based on https://github.com/yamashiro/php_enum
  */
abstract class Enum {
    public function name() {
         $reflection = new ReflectionClass(get_class($this));
         $staticProperties = $reflection->getStaticProperties();
         foreach ($staticProperties as $name => $value) {
             if ($value === $this) {
                 return $name;
             }
         }
    }

    public static function valueOf($name) {
        $clazz = get_called_class();
        if (isset($clazz::$$name)) {
            return $clazz::$$name;
        }
        throw new Exception('undefined. name['.$name.'] $clazz['.$clazz.']');
    }
}

?>

