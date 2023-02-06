<a class="btn btn-primary mb-3" href="/">Home page</a>

<form class="row w-25" action="/update/<?php echo $section['id']; ?>" method="post">
    <div class="col-md-12">
        <label for="name">Section Name:</label>
        <input value="<?php echo $section['name']; ?>"
               type="text"
               id="name"
               name="name"
               class="form-control"
               required>
    </div>
    <div class="col-md-12 my-2">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description"><?php echo $section['description']; ?></textarea>
    </div>
    <div class="col-md-12">
        <label for="parent">Parent Section:</label>
        <select class="form-select" id="parent" name="parent_id">
            <?php
                echo '<option value="null"';
                echo ($section['parent_id'] === null) ? ' selected' : '';
                echo '>None</option>';

                foreach ($sections as $sectionOption):
                    if ($sectionOption['id'] === $section['id']) {
                        continue;
                    }

                    echo '<option value="'. $sectionOption['id'] .'"';
                    echo ($sectionOption['id'] === $section['parent_id']) ? ' selected' : '';
                    echo '>'. $sectionOption['name'] .'</option>';
                endforeach;
            ?>
        </select>
    </div>
    <div class="col-md-12">
        <button class="btn btn-success mt-2" type="submit">Update</button>
    </div>
</form>
