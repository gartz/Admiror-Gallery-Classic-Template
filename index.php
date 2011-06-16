<?php

// Joomla security code
defined('_JEXEC') or die('Restricted access');

// Load CSS from current template folder
$AG->loadCSS($AG->currTemplateRoot.'template.css');
$AG->loadCSS($AG->currTemplateRoot.'albums/albums.css');
$AG->loadCSS($AG->currTemplateRoot.'pagination/pagination.css');



// Reset $html variable from previous entery and load it with scripts needed for Popups
$html=$AG->initPopup();

// Form HTML code, with unique ID and Class Name
$html.='<!-- ======================= Admiror Gallery -->
<style type="text/css">
     .AG_classic .ag_imageThumb{border-color:#'.$AG->params['foregroundColor'].'}
     .AG_classic .ag_imageThumb:hover{background-color:#'.$AG->params['highliteColor'].'}
</style>
<div id="AG_'.$AG->getGalleryID().'" class="AG_'.$AG->params['template'].'">
  <table cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <tr>
	<td>';

	// Loops over the array of images inside target gallery folder, adding wrapper with SPAN tag and write Popup thumbs inside this wrapper
	foreach ($AG->images as $imageKey => $imageName){
		$html.= '<span class="ag_thumb'.$AG->params['template'].'">';
		$html.= $AG->writePopupThumb($imageName);
		$html.='</span>';
	}

	$html .='
	</td>
      </tr>
    </tbody>
  </table>
</div>
';

// Support for Pagination
$html.= $AG->writePagination();

// Support for Albums
if(!empty($AG->folders) && $AG->params['albumUse']){
     $html.= '<h1>'.JText::_( 'Albums' ).'</h1>'."\n";
     $html.= $AG->writeFolderThumb("albums/album.png", $AG->params['thumbHeight']);
}

// Loads scripts needed for Popups, after gallery is created
$html.=$AG->endPopup();

