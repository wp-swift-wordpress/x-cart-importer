<?php
if (!count($category_terms)):
    ?>
        <div class="callout alert">
            <h3>Category Products Empty</h3>

            <hr>

            <p class="lead">The <b>WordPress</b> database does not have any product categories saved.</p>
            <p>Would you like to import the following categories?</p>

            <div class="callout">

                <?php if (count($categories_names)): ?>
                    <ul>
                        <?php foreach ($categories_names as $category => $count): ?>
                            <li><?php echo $category ?> <span class="label success"><?php echo $count ?></span></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>

                <p><small>The green <span class="label success">box</span> indicates the occurrence count.</small></p>

                <form action="" method="post" id="save-categories-form" class="js-check-form" name="save-categories-form" novalidate="">
                    <button type="submit" name="save-categories" class="button large" tabindex="4">Save Categories</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="callout warning">
            <h3>Category Products</h3>

            <hr>

            <p class="lead">These are the category product slugs saved into the <b>WordPress</b> database.</p>

            <div class="callout">
                
                <?php foreach ($category_terms as $category => $id): ?>
                            <pre><?php echo $category ?> <span class="label warning"><?php echo $id ?></span></pre>
                        <?php endforeach ?>
                <br>
                <p><small>The yellow <span class="label warning">box</span> indicates the post ID.</small></p>

            </div>
        </div>            
    <?php
endif;