<?php
/**
 * @package		K2
 * @author		GavickPro http://gavick.com
 */
// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
?>
<li>
    <article>

        <span class="cbp_tmtime" >

            
                 <?php if ($this->item->params->get('catItemDateCreated')): ?>
                <!-- Date created -->
                <?php $datetime=$this->item->created; ?>
      <?php endif; ?>
                
                <?php if ($this->item->params->get('catItemDateModified')): ?>
                <!-- Item date modified -->
                    <?php if ($this->item->modified != $this->nullDate && $this->item->modified != $this->item->created): ?>
                  
                    <?php $datetime=$this->item->modified; ?>

                    <?php endif; ?>
                <?php endif; ?>
                
           
<?php 
//see: http://www.brucelawson.co.uk/2012/best-of-time/
?>

            <time class="thedate" pubdate="true" datetime="<?php echo  JHTML::_('date', $datetime, "Y-m-d H:i");?>">
                <?php echo  JHTML::_('date', $datetime, "d/m/y");?>
            </time> 
            <time class="thehour" datetime="<?php echo  JHTML::_('date', $datetime, "Y-m-d H:i");?>">
                   <?php echo  JHTML::_('date', $datetime, "H:i");?>
            </time>
            <small class="authorInfo">
<?php if ($this->item->params->get('catItemAuthor') || true): ?>
                    <a rel="author" 
                       href="<?php echo $this->item->author->link; ?>">
                    <?php echo $this->item->author->name; ?>
                    </a>
                       <?php endif; ?>
            </small>
        </span>

        <div class="cbp_tmicon">
<?php if ($this->item->params->get('catItemImage') && !empty($this->item->image)): ?>
                <!-- Item Image -->
                <a href="<?php echo $this->item->link; ?>" title="<?php if (!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption);
    else echo K2HelperUtilities::cleanHtml($this->item->title); ?>">
                    <img src="<?php echo $this->item->image; ?>" alt="<?php if (!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption);
            else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" 
                         style="
                         width:<?php echo $this->item->imageWidth; ?>px;
                         height:auto;" />
                </a>
            <?php endif; ?>
        </div>

        <div class="cbp_tmlabel">
            <h3 class="timelinetitle">
                <?php if (isset($this->item->editLink)): ?>
                    <!-- Item edit link -->
                    <span class="catItemEditLink">
                        <a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
                            <?php echo JText::_('K2_EDIT_ITEM'); ?>
                        </a>
                    </span>
                <?php endif; ?>

                <?php if ($this->item->params->get('catItemTitleLinked')): ?>
                    <a href="<?php echo $this->item->link; ?>">
                        <?php echo $this->item->title; ?>
                    </a>
                <?php else: ?>
                    <?php echo $this->item->title; ?>
                <?php endif; ?>

                <?php if ($this->item->params->get('catItemFeaturedNotice') && $this->item->featured): ?>
                    <!-- Featured flag -->
                    <span>
                        <sup>
                            *
                        </sup>
                    </span>
                <?php endif; ?>
            </h3>
            <p>  
            <div class="catItemBody">

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
            </div></p>
        </div>
    </article>
</li>
