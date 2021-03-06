<?php
/**
 * Personality data type template
 *
 * @author      Nir Goldberg
 * @package     jewish-spotlight/bhjs-content/themes/bhjs/view/data-types
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $lang, $data;
$settings = array(
    'type_id'       => 8,
    'dbs_prefix'    => 'https://dbs.bh.org.il/' . ($lang == 'he' ? 'he/' : ''),
    'src_prefix'    => 'https://storage.googleapis.com/bhs-flat-pics/',
);

?>

<div class="data-type-section" id="data-type-section-luminary">
    
    <div><?php echo index_generator('luminary'); ?></div>

    <?php foreach ( $data[ $settings['type_id'] ] as $luminary ) {
        $title  = $luminary['Header'][ucfirst($lang)];
        if (empty($title)) {
            continue;
        }
        $desc   = $luminary['UnitText1'][ucfirst($lang)];
        if (empty($luminary['Slug'][ucfirst($lang)])) {
            $item_url = $luminary["item_url_".$lang];
        } else {
            $reversed_slug = explode("_", $luminary['Slug']['He']);
            $heb_slug = $reversed_slug[1] . '/' . $reversed_slug[0];
            $slug = $lang == 'he' ? $heb_slug : str_replace('_', '/', $luminary['Slug']['En']);
            $item_url = $settings['dbs_prefix'] . $slug;
        }
        $photo  = '';
        $pictures = $luminary['image_urls'];
        $luminary_photo = $luminary['preview_image_url'];

        ?>
        <div class="col-md-4 col-sm-6 col-xs-12 hidden">
            <div class="item-preview" data-letter="<?php echo ucfirst ( mb_substr($title, 0, 1, 'UTF-8') ); ?>">
              <a href="<?php echo $item_url; ?>" target="_blank">
                <div class="thumbnail">
                  <img src="<?php echo $luminary_photo; ?>" alt="<?php echo $title; ?>"/>
                </div>
                <div class="text-part <?php echo count($pictures)>0 ? 'text-part--thumbnail' : 'text-part--nothumb'; ?>">
                    <div class="text <?php echo count($pictures) == 0 ? 'text--nothumb' : ''; ?>">
                        <?php echo $desc; ?>
                    </div>
                    <div class="<?php echo count($pictures) ? 'diagonal-block' : ''?>">
                        <div class="diagonal-separator" style="right:-22px; opacity:1"></div>
                        <div class=" <?php echo count($pictures)>1 ? 'diagonal-separator' : '' ?>" style="right:-10px; opacity:0.7"></div>
                        <div class=" <?php echo count($pictures)>1 ? 'diagonal-separator' : '' ?>" style="right:2px; opacity:0.4"></div>
                    </div>
                    <div class="header <?php  echo count($pictures) == 0 ? 'header--nothumb' : '' ?>">
                        <?php echo $title ?>
                    </div>
                </div>
              </a>
            </div>
        </div>
    <?php } ?>

    <p class="notification"><?php echo ( $lang == 'en' ? 'No items found, please try another search' : 'לא נמצאו פריטים, אנא נסו חיפוש אחר' ); ?></p>
</div>