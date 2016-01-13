<?php
class Tortilla
{
    public $steps;
    public $coords = ['x' => 0, 'y' => 0];
    public $collision_step;

    public function run($steps)
    {
        $this->steps = $steps;
        $out = true;

        for ($i = 0; $i < count($steps); $i++) {
            $this->calcCoords($i);

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
                    $this->calcCoords($i, true);
                    return false;
                }
            }
        }

        return true;
    }

    private function calcCoords($step, $collison = false)
    {
        $coord = $step % 2 == 1 ? 'x': 'y';
        $sign = (($step + 4) % 4 == 0 || ($step + 4) % 4 == 1) ? 1 : -1;

        if ($collison) {
            $this->coords[$coord] += $sign * ($this->steps[$step - 2] - $this->steps[$step]);
        } else {
            $this->coords[$coord] += $sign * $this->steps[$step];
        }
    }

}

$tortilla = new Tortilla();
$tortilla->run([1, 2, 3,4,5,10,4,100]);
print_r($tortilla->coords);

