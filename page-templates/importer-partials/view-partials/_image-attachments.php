<?php
if (count($category_terms) && count($tag_terms) && !count($image_attachments)): ?>

    <div class="callout alert">
        <h3>Media Library Empty</h3>

        <hr>

        <p class="lead">The <b>WordPress</b> media library is empty. Please upload the images from your X-Cart media folder.</p>
        <p>You should use the <b>Media Manager</b> in the backend to do this as it is the most efficient method.</p>

        <h4>How to Do This:</h4>
        <h6><b>(1) Batches</b></h6>
        <p>Do not upload a huge amount of images at the same. This will overload the server.</p>

        <p>Instead, spilt the folder into several smaller folders. Use the snippet below to the this in terminal. Simply <i>cd</i> into the folder and run this command. It will spilt a large directory into batches of 50.</p>

        <div class="callout">

            <pre>i=0; for f in *; do d=dir_$(printf %03d $((i/50+1))); mkdir -p $d; mv "$f" $d; let i++; done</pre>
        </div>
        <h6><b>(2) Rename Images</b></h6>
        <p>As we know, <b>WordPress</b> will sanitize the file name on upload meaning it will replace spaces with dashes, lowercase etc. The original filename is then used as the title.</p>

        <p>We do not want to this. Instead, run the names through a program such as  <a href="https://manytricks.com/namemangler/" target="_blank"><b>Name Mangler</b></a> and sanitise the filenames yourself. This makes it easier to link the images in the next step.</p>

        <p>Here are the settings I used:</p>

        <div class="callout">

            <pre>1) change to lowercase</pre>
            <pre>2) Replace "  " with - (replace double space with dash)</pre>
            <pre>3) Replace " " with - (replace single space with dash)</pre>
            <pre>4) Replace "- " with - (replace dash &amp; space with dash)</pre>
            <pre>5) Replace "_" with - (replace underscore with dash)</pre>
            <br>
            <p>Make sure all filenames are unique.</p>
        </div>

        <p>This wil aslo tell us if there if there is going to name conflicts after sanitization. This would occur if two name were differnet but the same same after</p>

        <h6><b>Come back here and reload when the images are imported.</b></h6>

    </div>

<?php else: ?>
    <div class="callout warning">
        <h3>Media Library</h3>

        <hr>

        <p class="lead">These are a selection of the images in the <b>WordPress</b> media library.</p>

        <div class="callout">
            
            <?php 
                $image_attachment_objects = get_image_attachment_objects();
                $count = 0;
             ?>
             <?php foreach ($image_attachment_objects->posts as $image): $count++;?>
                <?php if ($count<=50): ?>
                    <?php $thumb = wp_get_attachment_image_src( $image->ID ); ?>
                    <img src="<?php echo $thumb[0] ?>" alt="" class="thumbnail" style="margin-right:15px; margin-bottom:15px; width: 90px; heigh: auto;">                         
                <?php endif ?>
             <?php endforeach ?>
        </div>

        <p>This does not mean all images have been imported.</p>
    </div>            
<?php
endif;