<?php
if (!empty($sectionInfo)) {
    $parent = $sectionInfo[0];

    if (!is_null($parent['parent_id'])) {
        echo '<a href="/section/'.$parent['parent_id'].'">&laquo; To parent</a>';
    }

    echo '<h1>Section name - '.$parent['name'].'</h1>';

    echo '<p>Section description - <b>'.$parent['description'].'</b></p>';

    echo '<a class="btn btn-sm btn-primary px-3 mb-2" href="/edit/'.$parent['id'].'">Edit section</a>';

    echo '<h2>Child sections:</h2>';

    echo '<ul>';
        foreach ($sectionInfo as $row) {
            if (!empty($row['child_id'])) {
                echo "<li><a href='/section/".$row['child_id']."'>".$row['child_name']."</a></li>";
            } else {
                echo 'The children have not been found.';
            }
        }
    echo "</ul>";
}
