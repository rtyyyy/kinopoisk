<?php
/**
 * @var \App\Kernel\View\View $view
 */
?>
<?php $view->component('start'); ?>
<h1>add movie</h1>

<form action="/admin/movies/add" method="post">
    <p>name</p>
    <div>
        <input type="text">
    </div>
    <div>
        <button>add</button>
    </div>
</form>
<?php $view->component('end'); ?>