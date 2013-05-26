<?php
/**
 * @package		K2
 * @author		GavickPro http://gavick.com
 */
// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
$isFeatured = false;

if ($this->item->params->get('catItemFeaturedNotice') && $this->item->featured) {
    $isFeatured = true;
}
?>
<li class="timelinearticle">
    <article>

        <span class="cbp_tmtime" >
            

            <?php if ($this->item->params->get('catItemDateCreated')): ?>
                <!-- Date created -->
                <?php $datetime = $this->item->created; ?>
            <?php endif; ?>

            <?php if ($this->item->params->get('catItemDateModified')): ?>
                <!-- Item date modified -->
                <?php if ($this->item->modified != $this->nullDate && $this->item->modified != $this->item->created): ?>

                    <?php $datetime = $this->item->modified; ?>

                <?php endif; ?>
            <?php endif; ?>


            <?php
//see: http://www.brucelawson.co.uk/2012/best-of-time/
            ?>

            <time class="thedate" pubdate="true" datetime="<?php echo JHTML::_('date', $datetime, "Y-m-d H:i"); ?>">
                <i class="authoricon icon-time"></i> <?php echo JHTML::_('date', $datetime, "d/m/y"); ?>
            </time> 
            <time class="thehour" datetime="<?php echo JHTML::_('date', $datetime, "Y-m-d H:i"); ?>">
                <?php echo JHTML::_('date', $datetime, "H:i"); ?>
            </time>
            <div style="" class="authorInfo">
            <small>
                <i class="authoricon icon-pencil"></i>
                <?php if ($this->item->params->get('catItemAuthor') || true): ?>
                    <a rel="author" 
                       href="<?php echo $this->item->author->link; ?>">
                           <?php echo $this->item->author->name; ?>
                    </a>
                <?php endif; ?>
            </small>
            </div>
            <div style="" class="categoryInfo">
                <small>   
                    <i class="categoryicon icon-tag"></i>
                    <?php if($this->item->params->get('catItemCategory')): ?>
		      <a href="<?php echo $this->item->category->link; ?>">
                          <?php echo $this->item->category->name; ?>
                      </a> 
		    <?php endif; ?>
                 </small>
            </div>
        </span>
        <div class="cbp_tmicon_outer">
            <div class="cbp_tmicon">
                <?php if ($this->item->params->get('catItemImage') && !empty($this->item->image)) { ?>
                    <!-- Item Image -->
                    <a class="timelinearticleLink" href="<?php echo $this->item->link; ?>" title="<?php
                    if (!empty($this->item->image_caption))
                        echo K2HelperUtilities::cleanHtml($this->item->image_caption);
                    else
                        echo K2HelperUtilities::cleanHtml($this->item->title);
                    ?>">
                        <img 
                            class="kenburnsloop"
                            src="<?php echo $this->item->image; ?>" 
                            alt="<?php
                            if (!empty($this->item->image_caption))
                                echo K2HelperUtilities::cleanHtml($this->item->image_caption);
                            else
                                echo K2HelperUtilities::cleanHtml($this->item->title);
                            ?>" 
                            style="
                            width:<?php echo $this->item->imageWidth; ?>px;
                            height:auto;" />
                    </a>
                <?php } else { //image not present or don't show
                    ?>
                    <a href="<?php echo $this->item->link; ?>" title="<?php
                    if (!empty($this->item->image_caption))
                        echo K2HelperUtilities::cleanHtml($this->item->image_caption);
                    else
                        echo K2HelperUtilities::cleanHtml($this->item->title);
                    ?>">
                        <i class="readicon icon-ellipsis-horizontal"></i>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        $featuredBgEnabled=true; /* set this off if you don't want featured bg */
        $isFeaturedImgBg = false;
        $extraStyle = " style='";
        if ($isFeatured) {
            if ($this->item->params->get('catItemImage') && !empty($this->item->image) && $featuredBgEnabled==true) {
                $imgSrc = $this->item->image;
                $imgSrc = str_replace("_S.jpg", "_L.jpg",$imgSrc);
                $imgSrc = str_replace("_XS.jpg", "_L.jpg",$imgSrc);
                $imgSrc = str_replace("_M.jpg", "_L.jpg",$imgSrc);
                $isFeaturedImgBg = true;
                $extraStyle .= "background: url($imgSrc); ";
                $extraStyle .= "background-size: 100%; ";
                $extraStyle .= "
                    -o-box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.75);
                    -ms-box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.75);
                    -moz-box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.75);
                    -webkit-box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.75);
                    -khtml-box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.75);
                    box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.75);
                    
                    padding: 0px !important;

                   
                ";
                ?>
                <?php
            }
        }
        $extraStyle .= "';"
        ?>
        <a class="timelinearticleLink" href="<?php echo $this->item->link; ?>">
        <div <?php echo $extraStyle; ?> class="cbp_tmlabel">   
            <?php
            if ($isFeaturedImgBg) {
                ?>
                <div class="featuredBackgroundOverlay">
                    <?php
                }
                ?>
                <h3 class="timelinetitle">
                    <?php if (isset($this->item->editLink)): ?>
                        <!-- Item edit link -->
                        <span class="catItemEditLink">
                            <a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
                                <?php echo JText::_('K2_EDIT_ITEM'); ?>
                            </a>
                        </span>
                    <?php endif; ?>

               
                    <?php echo $this->item->title; ?>
             

                    <?php if ($isFeatured) { ?>
                        <!-- Featured flag -->
                        <span>
                            <sup>
                                <i class="featuredicon icon-star"></i>
                            </sup>
                        </span>
                    <?php } ?>
                </h3>
                <div class="itembody">

                    <!-- Plugins: BeforeDisplayContent -->
                    <?php echo $this->item->event->BeforeDisplayContent; ?>

                    <!-- K2 Plugins: K2BeforeDisplayContent -->
                    <?php echo $this->item->event->K2BeforeDisplayContent; ?>


                    <?php if ($this->item->params->get('catItemIntroText')): ?>
                        <!-- Item introtext -->
                        <div class="catItemIntroText">
                            <?php echo strip_tags($this->item->introtext, "<a><b><i>"); ?>
                        </div>
                    <?php endif; ?>

                    <div class="clr"></div>

                    <?php if ($this->item->params->get('catItemExtraFields') && count($this->item->extra_fields)): ?>
                        <!-- Item extra fields -->
                        <div class="catItemExtraFields">
                            <h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
                            <ul>
                                <?php foreach ($this->item->extra_fields as $key => $extraField): ?>
                                    <?php if ($extraField->value): ?>
                                        <li class="<?php echo ($key % 2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
                                            <span class="catItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
                                            <span class="catItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                            <div class="clr"></div>
                        </div>
                    <?php endif; ?>

                    <!-- Plugins: AfterDisplayContent -->
                    <?php echo $this->item->event->AfterDisplayContent; ?>

                    <!-- K2 Plugins: K2AfterDisplayContent -->
                    <?php echo $this->item->event->K2AfterDisplayContent; ?>

                    <div class="clr"></div>
                </div>
            </div>
            <?php
            if ($isFeaturedImgBg) {
                ?>
            </div>
            <?php
        }
        ?>
        </a>
    </article>
</li>
