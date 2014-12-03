<?php
App::use('Helper', 'Html');
class ApplicationHtmlHelper extends HtmlHelper {

    $_tags['polymertemplate'] = '<link rel="import" href="%s">';

/*
 * Add polymer-template
*/
    public function polymerTemplate($path) {
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
		$url = $this->assetUrl($path, array('pathPrefix' => 'polymer'));
	}
	return sprintf($this->_tags['polymertemplate'], $url);
    }
}
?>
