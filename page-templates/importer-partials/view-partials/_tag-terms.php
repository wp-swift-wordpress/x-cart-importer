<?php
if (count($category_terms) && (!count($tag_terms)) ): ?>

    <div class="callout alert">
        <h3>Product Tags Empty</h3>

        <hr>

        <p class="lead">The <b>WordPress</b> database does not have any product tags saved.</p>
        <p>Would you like to import the following tags?</p>

        <div class="callout">

            <div class="row small-up-2 medium-up-2 large-up-3">
                <?php $i = 0; ?>
                <?php foreach ($tag_occurences as $tag => $count):  $i++; ?>
                    <div class="column column-block">
                        <div class="callout success">
                            <div class="float-right"><span class="label secondary"><?php echo $i; ?></span></div>
                            <p><?php echo $tag ?> <span class="label success"><?php echo $count ?></span></p>
                            <pre><?php echo slug($tag) ?></pre>
                            
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <p><small>The green <span class="label success">box</span> indicates the occurrence count.</small></p>

            <form action="" method="post" id="save-tags-form" class="js-check-form" name="save-tags-form" novalidate="">
                <button type="submit" name="save-tags" class="button success large" tabindex="4">Save Tags</button>
            </form>
        </div>
    </div>

<?php else: ?>
    <div class="callout warning">
        <h3>Products Tags</h3>

        <hr>

        <p class="lead">These are all the tags (slugs) saved into the <b>WordPress</b> database.</p>

        <div class="callout">
            <?php foreach ($tag_terms as $tag => $id): ?>
                <?php echo $tag ?> <span class="label warning"><?php echo $id ?></span>, 
            <?php endforeach ?>

        <br><br>
        <p><small>The yellow <span class="label warning">box</span> indicates the post ID.</small></p>

        </div>
    </div>            
<?php
endif;