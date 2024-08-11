php
class Gabow {
    public $graph;  
    public $num;  
    public $stack;  
    public $low;  
    public $components;  
    public $numMap;  
    public $visited;

    public function __construct($graph) {
        $this->graph = $graph;  
        $this->num = 0;  
        $this->stack = [];  
        $this->low = [];  
        $this->components = [];  
        $this->numMap = [];  
        $this->visited = [];
    }

    public function getG() {
        foreach (array_keys($this->graph) as $vertex) {
            if (!isset($this->numMap[$vertex])) {
                $this->strongC($vertex);
            }
        }
        return $this->components;
    }

    public function strongC($v) {
        $this->numMap[$v] = $this->num;  
        $this->low[$v] = $this->num;  
        $this->num++;
        array_push($this->stack, $v);
        $this->visited[$v] = true;

        foreach ($this->graph[$v] as $w) {
            if (!isset($this->numMap[$w])) {
                $this->strongC($w);  
                $this->low[$v] = min($this->low[$v],  $this->low[$w]);
            } 
        }

        if ($this->low[$v] == $this->numMap[$v]) {
            $component = [];
            do {
                $w = array_pop($this->stack);
                $component[] = $w;
            } while ($w != $v);
            $component[] = $v; // Include the root of the component
            $this->components[] = $component;
        }
    }
}
