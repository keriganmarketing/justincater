## Cyclone Slider 2 Seamless

This theme displays a full-width slideshow that crops image sides when window width becomes less than the original width of the image.

### Usage

**Set up**

1. Download package.
2. Extract to `wp-content/themes/<yourtheme>/cycloneslider`
3. Rename folder to `seamless`. Ensure that `.git` is removed.
4. Add the following to `functions.php`

```
remove_image_size('cyclone-slider2-seamless-slide');
add_image_size('cyclone-slider2-seamless-slide',<original-image-width>,<original-image-height>,true);
```

5. Replace `<original-image-width>` with the original width of the image.
6. Replace `<original-image-height>` with the original height of the image.
7. In `<yourtheme>/cycloneslider/seamless/slider.php` line 94, replace `1258` with the minimum width of the site. 

**Create slideshow**

1. On `Dashboard->Cyclone Slider`, `add` a new slideshow.
2. Select `Seamless` as the template.
3. Click `Add images as slides` and upload the images.
4. Click `Update`
5. Paste the shortcode or PHP code to where the slideshow must appear on.


### Compatibility

* Cyclone Slider 2.10.5 and above

### Issues

Report bugs to this project's issue tracker. Bugs reported elsewhere will not be entertained.