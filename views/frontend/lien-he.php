<?php


require_once "views/frontend/header.php"; ?>

<?php

use App\Models\Contact;

$contact = new Contact;

if (isset($_POST['CONTACT'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $contact->name = $name;
    $contact->email = $email;
    $contact->phone = $phone;
    $contact->title = $title;
    $contact->content = $content;
    $contact->created_at = date('Y-m-d H:i:s');
    $contact->status = 1;
    $contact->save();

    echo "Lời nhắn của bạn đã được ghi lại.";
}

?>

<div class="container-md">
    <section>
        <div class="row">
            <form action="" method="post">
                <h1>Liên hệ với chúng tôi</h1>
                <button type="submit" name="CONTACT" class="btn btn-primary my-2">Submit</button>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tên của bạn</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                    <input type="number" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15675.688708694193!2d106.78244315!3d10.81726755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1700082622426!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</div>
<?php require_once "views/frontend/footer.php"; ?>