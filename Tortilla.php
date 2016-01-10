<?php
class Tortilla
{
    public $collision_step;

    public function run($steps)
    {
        $out = true;

        for ($i = 0; $i < count($steps); $i++) {
            if ($i < 2) {
                continue;
            }

            if ($out) {
                if ($steps[$i] <= $steps[$i - 2]) {
                    $out = false;
                }
            } else {
                if ($steps[$i] >= $steps[$i - 2]) {
                    $this->collision_step = $i;
                    return false;
                }
            }
        }

        return true;
    }
}
