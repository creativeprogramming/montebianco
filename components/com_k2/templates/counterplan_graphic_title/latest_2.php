<?php

/**
 * @version		$Id: latest.php 
 * @package		K2 Montebianco
 * @author		creativeprogramming.it http://www.creativeprogramming.it
 * @copyright	Copyright (c) 2013 creativeprogramming.it. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
$doc =& JFactory::getDocument();
$doc->addStyleSheet( '/components/com_k2/templates/counterplan_graphic_title/css/commons.css' );
$doc->addStyleSheet( '/components/com_k2/templates/counterplan_graphic_title/css/category.css' );
$doc->addStyleSheet( '/components/com_k2/templates/counterplan_graphic_title/css/item.css' );
$doc->addScript( '/components/com_k2/templates/counterplan_graphic_title/js/jquery-timeago/jquery.timeago.js' );
$doc->addScript( '/components/com_k2/templates/counterplan_graphic_title/js/jquery-timeago/locales/jquery.timeago.it.js' );
$doc->addScript( '/components/com_k2/templates/counterplan_graphic_title/js/pagination/creativeprogramming.it_pagination.awesomeness.js' );

?>
<script type="text/javascript">
   jQuery(document).ready(function() {
     jQuery("time.thedate").timeago();
   });
</script>


<!-- Start K2 Category Layout -->

<div id="system"> <!-- for yoo css e.g pagination -->
<div id="k2Container" class="creativeprogrammingTimeline itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<header>
		<h1><?php echo $this->escape($this->params->get('page_title')); ?></h1>
  	</header>
  	<?php endif; ?>
  
  	<?php foreach($this->blocks as $key=>$block): ?>
  		<?php if($this->params->get('latestItemsCols') > 1) : ?>
  		<div class="itemsContainerWrap itemsContainerWrap<?php echo $this->params->get('latestItemsCols'); ?>">  
    	<?php endif; ?>
    
    	<?php if($this->source=='categories'): $category=$block; ?>
	    	<?php if($this->params->get('categoryFeed') || $this->params->get('categoryImage') || $this->params->get('categoryTitle') || $this->params->get('categoryDescription')): ?>
	    	<div class="itemsCategory">
	      		<?php if ($this->params->get('categoryImage') && !empty($category->image)): ?>
	      		<img src="<?php echo $category->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($category->name); ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px;height:auto;" />
	      		<?php endif; ?>
	      		
	      		<?php if ($this->params->get('categoryTitle')): ?>
	      		<h2><a href="<?php echo $category->link; ?>"><?php echo $category->name; ?></a></h2>
	      		<?php endif; ?>
	      
	      		<?php if ($this->params->get('categoryDescription') && isset($category->description)): ?>
	      		<p><?php echo $category->description; ?></p>
	      		<?php endif; ?>
	      		
	      		<?php echo $category->event->K2CategoryDisplay; ?>
	    	</div>
	    
	    	<?php if($this->params->get('categoryFeed')): ?>
	    	<a class="k2FeedIcon" href="<?php echo $category->feed; ?>"><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></a>
	    	<?php endif; ?>
    	<?php endif; ?>
    <?php else: $user=$block; ?>
	    <?php if ($this->params->get('userFeed') || $this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')): ?>
	    <div class="itemAuthorBlock">
	        <?php if ($this->params->get('userImage') && !empty($user->avatar)): ?>
	        <div class="gkAvatar">
	        	<img src="<?php echo $user->avatar; ?>" alt="<?php echo $user->name; ?>" style="width:<?php echo $this->params->get('userImageWidth'); ?>px;height:auto;" />
	        </div>
	        <?php endif; ?>
	        
	        <div class="itemAuthorDetails">
		        <?php if ($this->params->get('userName')): ?>
		        <h3><a rel="author" href="<?php echo $user->link; ?>"><?php echo $user->name; ?></a></h3>
		        <?php endif; ?>
		        
		        <?php if ($this->params->get('userDescription') && isset($user->profile->description)): ?>
		        	<?php echo $user->profile->description; ?>
		        <?php endif; ?>
		        

				<?php if ($this->params->get('userURL') && isset($user->profile->url)): ?>
				<span class="itemAuthorURL">
					<?php echo JText::_('K2_WEBSITE_URL'); ?>: <a rel="me" href="<?php echo $user->profile->url; ?>" target="_blank"><?php echo $user->profile->url; ?></a>
				</span>
				<?php endif; ?>
				
				<?php if ($this->params->get('userEmail')): ?>
					<span class="itemAuthorEmail"> <?php echo JText::_('K2_EMAIL'); ?>: <?php echo JHTML::_('Email.cloak', $user->email); ?> </span>
				<?php endif; ?>
	        </div>
	        <?php echo $user->event->K2UserDisplay; ?>
	    </div>
	    
	    <?php if($this->params->get('userFeed')): ?>
	    <a class="k2FeedIcon" href="<?php echo $user->feed; ?>"><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></a>
	    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
    

   
      	


	<!-- Item list -->
	<ul class="cbp_tmtimeline">
                    <?php if($this->params->get('latestItemsDisplayEffect')=="first"): ?>
      	<?php foreach ($block->items as $itemCounter=>$item): K2HelperUtilities::setDefaultImage($item, 'latest', $this->params); ?>
            <?php $this->item=$item; ?>
                     <li 
                        data-page="<?php echo $this->pagination->pagesCurrent;?>" 
                        class="creativeprogrammingAwesomePageStart creativeprogrammingAwesomePageStartOf_<?php echo $this->pagination->pagesCurrent;?>"></li>
                    <?php
                    echo $this->loadTemplate('item'); 
                       ?>
                    <li  data-page="<?php echo $this->pagination->pagesCurrent;?>" 
                        class="creativeprogrammingAwesomePageEnd creativeprogrammingAwesomePageEndOf_<?php echo $this->pagination->pagesCurrent;?>"></li>

            <?php endforeach; ?>
      <?php else: ?>
      	<?php foreach ($block->items as $item): K2HelperUtilities::setDefaultImage($item, 'latest', $this->params); ?>
      		<?php $this->item=$item; ?>
                 <li 
                    data-page="<?php echo $this->pagination->pagesCurrent;?>" 
                    class="creativeprogrammingAwesomePageStart creativeprogrammingAwesomePageStartOf_<?php echo $this->pagination->pagesCurrent;?>"></li>
                <?php
                echo $this->loadTemplate('item'); 
                   ?>
                <li  data-page="<?php echo $this->pagination->pagesCurrent;?>" 
                    class="creativeprogrammingAwesomePageEnd creativeprogrammingAwesomePageEndOf_<?php echo $this->pagination->pagesCurrent;?>"></li>

      	<?php endforeach; ?>
      <?php endif; ?>
              
	
               
        </ul>
       	<!-- Pagination -->
	<?php 
        //print_r($this->pagination);
        if(count($this->pagination->getPagesLinks())): ?>
         <!-- Creativeprogramming.it Pagination awesomeness -->
        <div class="creativeprogramming_it_awesome_pagination_slider"
             data-min="1"
             data-max="<?php echo $this->pagination->pagesTotal;?>"
             data-current="<?php echo $this->pagination->pagesCurrent;?>"
             data-elementsperpage="<?php echo $this->pagination->limit;?>"
             >
        </div>
         Pag. <b><span class="creativeprogramming_it_awesome_pagination_currentpage"></span></b>/<?php echo $this->pagination->pagesTotal;?>
        
       
       <?php 
         $debugPagination=false;
         $keepSEOCrawlersLinks=true;
         if ($debugPagination){ //set true to debug plain old pagination
           print_r($this->pagination);
         }
         if ($keepSEOCrawlersLinks){
	?>
         <!-- max-height,opcacity, and float left should ensure this block is hidden to the user
         but it should be considered valid and visible by crawlers
         TODO: test also screen readers and add some 
         aria attrs https://mikewest.org/2010/02/an-accessible-pagination-pattern 
         free screen reader win: http://www.nvaccess.org/ -->
         <div 
            style="max-height:0px!important; opacity: 0; float:left;"
            class="k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		<div class="clr"></div>
		<?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
	</div> 
       <?php 
       }?>
	<?php endif; ?>
        <?php endforeach; ?>

	
</div>
</div>
<!-- End K2 Category Layout -->

