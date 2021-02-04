<?php
echo "<ul class='pagination pull-left margin-zero mt0'>";

if($page>1){
    $prev_page = $page - 1;
    echo "<li>";
        echo "<a href='{$page_url}page={$prev_page}'>";
            echo "<span style='margin:0 .5em;'>«</span>";
        echo "</a>";
    echo "</li>";
}

$total_pages = ceil($total_rows / $records_per_page);

$range = 1;

$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;

for ($x=$initial_num; $x<$condition_limit_num; $x++) {

    if (($x > 0) && ($x <= $total_pages)) {

        if ($x == $page) {
            echo "<li class='active'>";
                echo "<a href='javascript::void();' style='margin:0 .5em;'>{$x}</a>";
            echo "</li>";
        }

        else {
            echo "<li>";
                echo " <a href='{$page_url}page={$x}' style='margin:0 .5em;'>{$x}</a> ";
            echo "</li>";
        }
    }
}

if($page<$total_pages){
    $next_page = $page + 1;

    echo "<li>";
        echo "<a href='{$page_url}page={$next_page}'>";
            echo "<span style='margin:0 .5em;'>»</span>";
        echo "</a>";
    echo "</li>";
}

echo "</ul>";
?>

<style>
li.active {
    background-color: #007bff;
}

li.active a {
    color: #fff;
}

ul.pagination li {
    border: 1px solid #dee2e6;
}
</style>