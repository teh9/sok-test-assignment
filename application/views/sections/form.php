<a class="btn btn-primary mb-3" href="/">Home page</a>

<form class="row w-25" action="/store" method="post">
    <div class="col-md-12">
        <label for="name">Section Name:</label>
        <input class="form-control" placeholder="Section name" type="text" id="name" name="name" required>
    </div>
    <div class="col-md-12 my-2">
        <label for="description">Description:</label>
        <textarea class="form-control" placeholder="Section description" id="description" name="description"></textarea>
    </div>
    <div class="col-md-12">
        <label for="parent">Parent Section:</label>
        <select class="form-select" id="parent" name="parent_id">
            <option value="null" selected>None</option>
            <?php
                foreach ($sections as $section):
                    echo '<option value="'. $section['id'] .'">'. $section['name'] .'</option>';
                endforeach;
            ?>
        </select>
    </div>
    <div class="col-md-12">
        <button class="btn btn-success mt-2" type="submit">Create</button>
    </div>
</form>
