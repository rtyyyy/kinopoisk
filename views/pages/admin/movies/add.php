<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>
<?php $view->component('start'); ?>
<h1>add movie</h1>

<form action="/admin/movies/add" method="post">
    <p>name</p>
    <div>
        <input type="text" name="name">
    </div>
    <?php if($session->has(key:'name')){ ?>
        <ul>
        <li style="color:red;">err1</li>
    </ul>
    <?php }?>
   
    <div>
        <button>add</button>
    </div>
</form>
<?php $view->component('end'); ?>