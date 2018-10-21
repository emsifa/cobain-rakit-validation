<?php

// Buat function untuk mempermudah mengambil data error
function get_error($key) {
    // Ambil errors pada $_GET
    // kalau nggak ada isi dengan array kosong aja.
    $errors = isset($_GET['errors']) ? (array) $_GET['errors'] : [];
    
    // Ambil pesan error
    $error = isset($errors[$key]) ? $errors[$key] : null;
    
    // Kalau memang ada error, 
    // harusnya $error disini masih berupa array ["rule" => "pesan"]
    // Karena kita hanya mau mengambil pesan pertamanya aja,
    // Jadi kita ambil via array_values($error)[0]
    $first_message = is_array($error) ? array_values($error)[0] : null;

    // Kembalikan pesan error
    return $first_message;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran</title>
    <!-- Sedikit style untuk warnai pesan error -->
    <style>
        .error-message { color: red }
    </style>
</head>
<body>
    <h2>Formulir Pendaftaran</h2>
    <form action="submit.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama"/>
                    <!-- Tampilkan error nama -->
                    <?php if($error = get_error('nama')): ?>
                    <span class="error-message"><?= $error ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>
                    <input type="text" name="email"/>
                    <!-- Tampilkan error email -->
                    <?php if($error = get_error('email')): ?>
                    <span class="error-message"><?= $error ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                    <input type="password" name="password"/>
                    <!-- Tampilkan error password -->
                    <?php if($error = get_error('password')): ?>
                    <span class="error-message"><?= $error ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Ulangi Password</td>
                <td>:</td>
                <td>
                    <input type="password" name="konfirmasi_password"/>
                    <!-- Tampilkan error konfirmasi_password -->
                    <?php if($error = get_error('konfirmasi_password')): ?>
                    <span class="error-message"><?= $error ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>:</td>
                <td>
                    <input type="file" name="foto"/>
                    <!-- Tampilkan error foto -->
                    <?php if($error = get_error('foto')): ?>
                    <span class="error-message"><?= $error ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button>Submit</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>