<?php
/**
 * @version		$Id: category.php 
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

$doc->addScript( '/plugins/k2/asynk2/assets/js/jquery-timeago/jquery.timeago.js' );
$doc->addScript( '/plugins/k2/asynk2/assets/js/jquery-timeago/locales/jquery.timeago.it.js' );

$doc->addScript( '/plugins/k2/asynk2/assets/js/pagination/creativeprogramming.it_pagination.awesomeness.js' );

//$doc->addScript( '/plugins/k2/asynk2/assets/js/imagesloaded.js' );
?>
<script>
setTimeout(function(){
     var article = jQuery("#k2Container");
      
    var lastyear = jQuery("time.thedate", article).filter(function() {
            var time = jQuery.timeago.parse(jQuery(this).attr("datetime")).getTime();
            if (((new Date().getTime()) - time) < 1000 * 60 * 60 * 24 * 396) {
                // //we convert the time to human readable "timeago" 
                // /until it is "about a year ago" plus about one month (e.g. if today is may 2013 we write about a year ago to may 2012) this is my  "about a year ago" concept!)     
                return true;
            }
            return false;
        });

        var timeAgoOnlyLastYear = false;
        if (timeAgoOnlyLastYear) {
            lastyear.timeago();
        } else {
            jQuery("time.thedate", article).timeago();
        }

        var olderthan2daysago = jQuery("time.thehour", article).filter(function() {
            var time = jQuery.timeago.parse(jQuery(this).attr("datetime")).getTime();
            if (((new Date().getTime()) - time) >= 1000 * 60 * 60 * 24 * 2) {
                // //we convert the time to human readable "timeago" 
                // /until it is "about a year ago" plus about one month (e.g. if today is may 2013 we write about a year ago to may 2012) this is my  "about a year ago" concept!)     
                return true;
            }
            return false;
        });

        olderthan2daysago.each(function(idx, elm) {
            var parsedDate = jQuery.timeago.parse(jQuery(elm).attr("datetime"));
            if (!jQuery(elm).hasClass("creative_timeago_monthdayparsed")) {
                jQuery(elm).html("<span class='thehour_wrapper'>" + jQuery(elm).html() + "</span>");
                jQuery(elm).addClass("creative_timeago_monthdayparsed").prepend("<small class='glomonthday'>" + Globalize.format(parsedDate, "d MMM").toUpperCase() + "</small>");
            }
            //see formats here: https://github.com/creativeprogramming/globalize
        });

        var olderthan1yearssago = jQuery("time.thehour", article).filter(function() {
            var time = jQuery.timeago.parse(jQuery(this).attr("datetime")).getTime();
            if (((new Date().getTime()) - time) >= 1000 * 60 * 60 * 24 * 365 * 1) {
                // //we convert the time to human readable "timeago" 
                // /until it is "about a year ago" plus about one month (e.g. if today is may 2013 we write about a year ago to may 2012) this is my  "about a year ago" concept!)     
                return true;
            }
            return false;
        });

        olderthan1yearssago.each(function(idx, elm) {
            var parsedDate = jQuery.timeago.parse(jQuery(elm).attr("datetime"));
            if (!jQuery(".glomonthday", elm).hasClass("creative_timeago_monthdayparsed")) {
                jQuery(".thehour_wrapper", elm).hide(); //hour is not so relevant now...
                jQuery(".glomonthday", elm).addClass("creative_timeago_monthdayparsed").append("<br/><small style='margin:0 auto; text-align:center; width:100%;'>" + Globalize.format(parsedDate, "yyyy").toUpperCase() + "</small>");
            }
            //see formats here: https://github.com/creativeprogramming/globalize
        });
},1000);
</script>
<div id="system"> <!-- for yoo css e.g pagination -->
<div id="k2Container" class="creativeprogrammingTimeline creativeCategory itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('catFeedIcon')): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
	<div class="itemListCategoriesBlock">

		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
		<div class="itemListCategory">

			<?php if(isset($this->addLink)): ?>
			<!-- Item add link -->
			<span class="catItemAddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
				</a>
			</span>
			<?php endif; ?>

			<?php if($this->params->get('catImage') && $this->category->image): ?>
			<!-- Category image -->
                        <img alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" src="<?php echo str_replace("_M.jpg", "_XL.jpg", $this->category->image); ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
			<?php endif; ?>

			<?php if($this->params->get('catTitle')): ?>
			<!-- Category title -->
			<h2 class="creativeCatTitle">
                            <span class="creativeCatSpan">
                            <?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?>
                            </span>
                        </h2>
			<?php endif; ?>

			<?php if($this->params->get('catDescription')): ?>
			<!-- Category description -->
			<div class="catDescription"><?php echo $this->category->description; ?></div>
			<?php endif; ?>

			<!-- K2 Plugins: K2CategoryDisplay -->
			<?php echo $this->category->event->K2CategoryDisplay; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
		<div title="Click to show/hide subcategories" onClick="jQuery('.itemListSubCategories').toggleClass('activated');" class="itemListSubCategories">
			<h3 class="subcatActivator">&gt; <?php echo JText::_('K2_CHILDREN_CATEGORIES'); ?></h3>

                        <?php
                        $flexiwidthrules="";
                        $countcat=count($this->subCategories);
                        if ($countcat>1){ 
                            $targetWidth=100/$this->params->get('subCatColumns');
                            $flexiwidthrules .= "max-width:".number_format($targetWidth,1)."%;";
                            $flexiwidthrules .= "width:".number_format($targetWidth,1)."%;";
                            $flexiwidthrules .= "width:auto;";
                            $flexiwidthrules .= "min-width:".number_format($targetWidth-2,1)."%;";
                        }
                        ?>
                        
			<?php foreach($this->subCategories as $key=>$subCategory): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('subCatColumns'))==0)){
				$lastContainer= ' subCategoryContainerLast';
                           //fix strange "creative flexiwidth" rendering bug of last element in last chrome and ff may 2013
                            $targetWidth=100/$this->params->get('subCatColumns');
                            $flexiwidthrules .= "max-width:".number_format($targetWidth-2,1)."%;";
                                
                        }else{
				$lastContainer='';
                        }
                        ?>
			<div class="subCategoryContainer<?php echo $lastContainer; ?>"
                             style="<?php echo $flexiwidthrules; ?>">
				<div class="creative_subCategory">
					<?php if($this->params->get('subCatImage') && $subCategory->image): ?>
					<!-- Subcategory image -->
					<a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
						<img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" />
					</a>
					<?php endif; ?>

					<?php if($this->params->get('subCatTitle')): ?>
					<!-- Subcategory title -->
					<h2>
                                          <span>
						<a href="<?php echo $subCategory->link; ?>">
							<?php echo $subCategory->name; ?><?php if($this->params->get('subCatTitleItemCounter')) echo ' ('.$subCategory->numOfItems.')'; ?>
						</a>
                                            </span>
					</h2>
					<?php endif; ?>

					<?php if($this->params->get('subCatDescription')): ?>
					<!-- Subcategory description -->
					<p><?php echo $subCategory->description; ?></p>
					<?php endif; ?>

					<!-- Subcategory more... -->
					<a class="subCategoryMore" href="<?php echo $subCategory->link; ?>">
						&nbsp;
					</a>

					<div class="clr"></div>
				</div>
			</div>
			<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
                        <!-- unsuccesfull try to fix or at least debug "last element"(??) flexi bug
                        <div class="subCategoryContainer<?php echo $lastContainer; ?>"
                             style="<?php echo $flexiwidthrules; ?>"></div>
                        <div class="subCategoryContainer<?php echo $lastContainer; ?>"
                             style="<?php echo $flexiwidthrules; ?>"></div>
-->
	
			<div class="clr"></div>
		</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>



	<?php 
        if(!isset($this->primary) || count($this->primary)==0){
            echo "<!-- Error: this template requires you use only 'primary' articles check menu item or category configuration -->";
        }
        
        if(isset($this->primary)): ?>
	<!-- Item list -->
	<ul class="cbp_tmtimeline">
                <li 
                    data-page="<?php echo $this->pagination->pagesCurrent;?>" 
                    class="creativeprogrammingAwesomePageStart creativeprogrammingAwesomePageStartOf_<?php echo $this->pagination->pagesCurrent;?>"></li>
		<!-- Leading items -->
		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->

			<?php foreach($this->primary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_primary_columns'))==0) || count($this->primary)<$this->params->get('num_primary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
					<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
		
			
		
			<?php endforeach; ?>
		<?php endif; ?>
                <li  data-page="<?php echo $this->pagination->pagesCurrent;?>" 
                    class="creativeprogrammingAwesomePageEnd creativeprogrammingAwesomePageEndOf_<?php echo $this->pagination->pagesCurrent;?>"></li>
        </ul>
       	<!-- Pagination -->
	<?php 
        //print_r($this->pagination);
        if(count($this->pagination->getPagesLinks()) && count($this->primary)>0 ): ?>
         <!-- start Creativeprogramming.it Pagination awesomeness  -->
        <div class="creativeprogramming_it_awesome_pagination_slider"
             data-min="1"
             data-max="<?php echo $this->pagination->pagesTotal;?>"
             data-current="<?php echo $this->pagination->pagesCurrent;?>"
             data-elementsperpage="<?php echo $this->pagination->limit;?>"
             >
        </div>
         Pag. <b><span class="creativeprogramming_it_awesome_pagination_currentpage"></span></b>/<?php echo $this->pagination->pagesTotal;?>
         <!-- end  Creativeprogramming.it Pagination awesomeness  -->
       
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
         free screen reader win: http://www.nvaccess.org/
         
         style="max-height:0px!important; opacity: 0; float:left;"
         
         -->
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
        

	<?php endif; ?>
</div>
</div>
<!-- End K2 Category Layout -->
