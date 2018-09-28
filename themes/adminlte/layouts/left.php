<?php
use app\models\User;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
               <?php if (User::isAdmin()) { ?>
                    <img src="img/admin.jpg" class="img-circle" alt="User Image"/>
                <?php } elseif (User::isAnggota()) { ?>
                    <img src="img/anggota.png" class="img-circle" alt="User Image"/>
                 <?php } elseif (User::isPetugas()) { ?>
                    <img src="img/petugas.jpg" class="img-circle" alt="User Image"/>
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php if (User::isAdmin()) { ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => ' ', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['site/dashboard']],
                    ['label' => ' ', 'options' => ['class' => 'header']],
                    ['label' => 'Buku', 'icon' => 'book', 'url' => ['buku/index']],
                    ['label' => 'Kategori', 'icon' => 'navicon', 'url' => ['kategori/index']],
                    ['label' => 'Penulis', 'icon' => 'user', 'url' => ['penulis/index']],
                    ['label' => 'Penerbit', 'icon' => 'user', 'url' => ['penerbit/index']],
                    [
                                        "label" => "Peminjaman",
                                        "icon" => "th",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Anggota", 'icon'=>'users', "url" => ["/anggota/index"]],
                                            ["label" => "Peminjaman Detail", 'icon'=> 'desktop', "url" => ["/peminjaman/index"]],
                                        ],
                   ],
                    ['label' => 'Petugas', 'icon' => 'user-plus', 'url' => ['petugas/index']],
                    ['label' => 'User', 'icon' => 'user', 'url' => ['user/index']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                  
                ],
            ]
        ) ?>
   <?php } elseif (User::isAnggota()) {?>

     <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Peminjaman', 'icon' => 'book', 'url' => ['peminjaman/index']],
                    // ["label" => "Anggota", 'icon'=>'users', "url" => ["/anggota/index"]],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>
     <?php } elseif (User::isPetugas()) {?>

     <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Peminjaman', 'icon' => 'book', 'url' => ['peminjaman/index']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>
    <?php } ?>
    </section>

</aside>
