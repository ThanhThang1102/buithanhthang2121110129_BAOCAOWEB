<?php

use App\Models\User;

$check = [
    [
        'status', '!=', 0
    ],
    [
        'roles', '=', 0
    ]
];

$list = User::where($check)
    ->orderBy('created_at', 'DESC')
    ->get();

$countTrash = User::where('status', '=', 0)->count();

?>



<?php require_once '../views/backend/header.php'; ?>
<!-- CONTENT -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="d-inline">Tất cả khách hàng</h1>
                    <a href="index.php?option=customer&cat=create" class="btn btn-sm btn-primary">Thêm tài khoản khách hàng</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <form action="index.php?option=customer&cat=delete" method="post">
                    <select name="action" class="form-control d-inline" style="width:100px;">
                        <option value="delete">Xoá</option>
                    </select>
                    <input type="hidden" id="selectedIds" name="selectedIds" value="">
                    <button type="submit" class="btn btn-sm btn-success">Áp dụng</button>
                    <a href="index.php?option=customer&cat=trash" class="btn btn-sm btn-danger">Thùng rác <span>(<?= $countTrash ?>)</span></a>
                </form>
            </div>
            <?php if (isset($_SESSION["message"])) : ?>
                <div class="alert alert-<?php echo $_SESSION["message"]["type"]; ?>">
                    <?php echo $_SESSION["message"]["msg"]; ?>
                </div>

                <?php
                unset($_SESSION["message"]);
                ?>
            <?php endif; ?>
            <div class="card-body">
                <table class="table table-bordered display" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:30px;">
                                <input type="checkbox" class="select-all">
                            </th>
                            <th class="text-center" style="width:130px;">Hình ảnh</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Quyền</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($list) > 0) : ?>
                            <?php foreach ($list as $item) : ?>
                                <tr class="datarow">
                                    <td>
                                        <input type="checkbox" class="select-item" data-id="<?= $item['id']; ?>">
                                    </td>
                                    <td>
                                        <img src="../public/images/user/<?= $item['image'] ?>" alt="<?= $item['image'] ?>" width="50">
                                    </td>
                                    <td>
                                        <div class="name">
                                            <?= $item['name']; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $item['email']; ?>
                                    </td>
                                    <td>
                                        <?= $item['phone']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($item['roles'] == 0) {
                                            echo 'admin';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="function_style">
                                            <?php if ($item['status'] == 1) : ?>
                                                <a class="text-success" href="index.php?option=customer&cat=status&id=<?= $item['id']; ?>">Hiện</a> |
                                            <?php else : ?>
                                                <a class="text-danger" href="index.php?option=customer&cat=status&id=<?= $item['id']; ?>">Ẩn</a> |
                                            <?php endif; ?>
                                            <a href="index.php?option=customer&cat=show&id=<?= $item['id']; ?>">Chi tiết</a> |
                                            <a href="index.php?option=customer&cat=delete&id=<?= $item['id']; ?>">Xoá</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>
<!-- END CONTENT-->
<?php require_once '../views/backend/footer.php'; ?>