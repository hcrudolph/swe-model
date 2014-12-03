<?php
//App::uses('HtmlHelper', 'View/Helper');
class PolymerHelper extends AppHelper {
	var $helpers = array('Html');
/*
 * Add polymer-template
*/
    public function template($path) {
        //Load path-array
        if(is_array($path))
        {
            foreach ($path as $pathValue)
            {
                this.polymer($pathValue);
            }
            return;
        }
        
        //Create Import-URL
        if (strpos($path, '//') !== false) {
		$url = $path;
	} else {
		$url = $this->assetUrl($path, array('pathPrefix' => 'polymer/'));
	}
	return sprintf('<link rel="import" href="%s">', $url);
    }
    
    public function script($path) {
        //Load path-array
        if(is_array($path))
        {
            foreach ($path as $pathValue)
            {
                this.polymer($pathValue);
            }
            return;
        }
        
        //Create Import-URL
        if (strpos($path, '//') !== false) {
		$url = $path;
	} else {
		$url = $this->assetUrl($path, array('pathPrefix' => 'polymer/'));
	}
	return $this->Html->script($url);
    }
}
?>
