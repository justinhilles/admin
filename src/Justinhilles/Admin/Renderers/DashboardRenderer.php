<?php namespace Justinhilles\Admin\Renderers;

class DashboardRenderer {

    private $_data;

    protected $fieldsets = array();

    protected $content = null;
   
    public function __construct(array $data)
    {
        $this->_data = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data), \RecursiveIteratorIterator::SELF_FIRST);
    }

    public function renderLink($link, $content)
    {
    	return sprintf('<div class="span3 icon" align="center">
                            <a href="%s">
                                <i class="%s icon-8x icon-border"></i>
                                <br /><br /><br />
                                <span class="title">%s</span>
                            </a>
                        </div>', 
                        \URL::route($link['route']), 
                        $link['icon'], 
                        $content );
    }

    public function renderLinks($links)
    {	
        $content = null;
        
        foreach($links as $title => $link) {
    		$content .= $this->renderLink($link, $title);
    	}

        return $content;
    }

    public function __toString()
    {
        return (string) $this->renderFieldsets();
    }

    public function renderFieldsets()
    {
        $fieldsets = null;
        
        foreach($this->getFieldsets() as $fieldset) {
            if($links = $this->getLinksForFieldset($fieldset)) {
                $fieldsets .= sprintf("<fieldset><legend>%s</legend>%s</fieldset>", $fieldset, $this->renderLinks($links));
            }
        }

        return $fieldsets;
    }

    public function getLinksForFieldset($fieldset)
    {
        $links = array();

        foreach($this->_data as $title => $link) {
            if(isset($link['fieldset']) AND $link['fieldset'] == $fieldset) {
                $links[$title] = $link;
            }
        }
        
        return $links;
    }

    public function getFieldsets()
    {
        $fieldsets = array();

        foreach($this->_data as $title => $link) {
            if(isset($link['fieldset'])) {
                $fieldsets[] = $link['fieldset'];
            }
        }

        return $fieldsets;
    }
}