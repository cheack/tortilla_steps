<?php
require 'Tortilla.php';

class TortillaTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider collisionProvider
     */
    public function testCollision($steps, $success)
    {
        $tortilla = new Tortilla();
        $result = $tortilla->run($steps);

        self::assertEquals($result, $success);
    }

    public function collisionProvider()
    {
        return [
            [[1, 1, 2, 2, 3, 3, 4], true],
            [[1, 2, 3, 4, 5, 6, 1], true],
            [[1, 2, 3, 4, 5, 1, 6], false],
            [[6, 6, 6, 5, 5, 4, 4, 3, 3, 2, 2, 1], true],
            [[6, 6, 6, 5, 5, 4, 5, 3, 3, 2, 2, 1], false],
            [[1, 1, 2, 2, 3, 3, 4, 4, 10, 5, 5, 4, 4, 3, 3, 2, 2, 1], true],
            [[1, 1, 2, 2, 3, 3, 4, 4, 10, 5, 5, 4, 6, 3, 3, 2, 2, 1], false],
            [[1, 1, 1, 1, 1], false],
            [[1, 1, 2, 1, 2], false]
        ];
    }

    /**
     * Читаем входные данные из файлов
     */
    public function testCollision2()
    {
        $tortilla = new Tortilla();

        # последняя строка - результат (1-успех, 0-фэйл)
        foreach (glob('input/*') as $file) {
            $steps = file($file, FILE_IGNORE_NEW_LINES + FILE_SKIP_EMPTY_LINES);
            $result = (bool)end($steps);
            self::assertEquals($tortilla->run($steps), $result);
        }
    }
}
