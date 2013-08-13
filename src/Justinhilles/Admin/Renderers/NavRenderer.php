<?php namespace Justinhilles\Admin\Renderers;

class NavRenderer extends \RecursiveIteratorIterator {

    protected $buffer = null;

    public static function create(array $data)
    {
        $renderer = new self(new \RecursiveArrayIterator($data),  \RecursiveIteratorIterator::SELF_FIRST);
        $renderer->render();
        return (string) $renderer;
    }

    public function callHasChildren()
    {
        $current = $this->getInnerIterator()->current();

        return (isset($current['children']));
    }

    public function callGetChildren()
    {
        $class = get_class($this->getInnerIterator());

        return new $class($this->getInnerIterator()->current()['children']);
    }

    public function render()
    {
        foreach($this as $link) {
            if($link = $this->current()) {
               $this->beforeCurrent();
               $this->buffer .= $link;
               $this->afterCurrent();
            }
        }
    }

    public function current()
    {
        if(isset(parent::current()['route'])) {
            return $this->wrap($this->key(), 'a', array(
                'href' => \URL::route(parent::current()['route']),
                'class' => ($this->callHasChildren() ? "dropdown-toggle" : null)
            ));
        }
        return false;
    }

    public function beforeCurrent()
    {
        $attributes = array();
        if($this->callHasChildren())
        {
            $attributes['class'] = 'dropdown';
        }
       $this->buffer .= $this->openTag("li", $attributes); 
    }

    public function afterCurrent()
    {
        $this->buffer .= (!$this->callHasChildren() ? "</li>": null);
    }

    public function beginChildren()
    {
        $attributes = array(
            'class' => "dropdown-menu"
        );
        $this->buffer .= $this->openTag('ul', $attributes);
    }

    public function endChildren()
    {
        $this->buffer .= "</ul>\n</li>\n";
    }

    public function __toString()
    {
        return (string) $this->buffer;
    }

    public function wrap($content, $tag = "li", $attributes = array())
    {
        return sprintf("%s%s</%s>\n", $this->openTag($tag, $attributes), $content, $tag);
    }

    public function openTag($tag, $attributes = array())
    {
        return sprintf("<%s %s>", $tag, $this->attributes($attributes));
    }

    public function attributes($attributes = array())
    {
        $html = array();
        foreach(array_filter($attributes) as $key => $value)
        {
            $html[] = implode("=", array($key, $value));
        }
        return implode(" ", $html);
    }
}