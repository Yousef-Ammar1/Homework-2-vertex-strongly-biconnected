php
class JensSchmidt {
    public $graph;  
    public $num;  
    public $stack;  
    public $points;  
    public $low;  
    public $onStack;  
    public $components;

    public function __construct($graph) {
        $this->graph = $graph;  
        $this->num = 0;  
        $this->stack = [];  
        $this->points = [];  
        $this->low = [];  
        $this->onStack = [];  
        $this->components = [];
    }

    public function getSCCs() {
        foreach (array_keys($this->graph) as $vertex) {
            if (!isset($this->points[$vertex])) {
                $this->strongC($vertex);
            }
        }
        return $this->components;
    }

    public function strongC($v) {
        $this->points[$v] = $this->num;  
        $this->low[$v] = $this->num;
        array_push($this->stack, $v);
        $this->onStack[$v] = true;

        foreach ($this->graph[$v] as $w) {
            if (!isset($this->points[$w])) {
                $this->strongC($w);
                $this->low[$v] = min($this->low[$v], $this->low[$w]);
            } elseif ($this->onStack[$w]) {
                // Corrected this line to use points of w
                $this->low[$v] = min($this->low[$v], $this->points[$w]);
            }
        }

        if ($this->low[$v] == $this->points[$v]) {
            $component = [];
            do {
                $w = array_pop($this->stack);
                array_pop($component); // Ensure we add the root node
                // Mark w as not on stack
                unset($this->onStack[$w]);
            } while ($w != $v);
            // Include the root of the component
            array_push($component, $v)

;
            $this->components[] = array_reverse($component); // Reverse to maintain order
        }
    }
}
