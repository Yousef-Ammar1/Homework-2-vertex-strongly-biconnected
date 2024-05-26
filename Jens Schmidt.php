<?php
//Yousef + Hussien + Hasan
class JensSchmidt {
    public $graph;  public $num;  public $stack;  public $points;  public $low;  public $onStack;  public $components;

    public function __construct($graph) {
        $this->graph = $graph;  $this->num = 0;  $this->stack = [];  $this->points = [];  $this->low = [];  $this->onStack = [];  $this->components = [];
    }

    public function getSCCs() {
        foreach (array_keys($this->graph) as $vertex) {
            if (!isset($this->points[$vertex])) {
                $this->strongC($verteex);
            }
        }
        return $this->components;
    }
//Maher + yazan + Ali + Ahmad
    public function strongC($v) {
        $this->points[$v] = $this->num;  $this->low[$v] = $this->num;
        array_push($this->stack, $v);
        $this->onStack[$v] = true;

        foreach ($this->graph[$v] as $w) {
            if (!isset($this->points[$w])) {
                $this->strongC($w);
                $this->low[$v] = min($this->low[$v], $this->low[$w]);
            } elseif ($this->onStack[$w]) {
                $this->low[$v] = min($this->low[$w], $this->points[$v]);
            }
        }

        if ($this->low[$v] == $this->points[$v]) {
            $component = [];
            do {
                $w = array_pop($this->stack);
                $component[] = $w;
            } while ($w != $v);
            $this->components[] = $component;
        }
    }
}
